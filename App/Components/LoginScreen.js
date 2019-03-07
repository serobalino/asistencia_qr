import React, { Component } from 'react'
import { reduxForm, Field } from 'redux-form';
import { StyleSheet, View, Text, Modal, Button, BackHandler , ToastAndroid , Vibration , Linking  } from 'react-native'
import TInput from './TInput'
import {BarCodeScanner, Permissions, Constants, WebBrowser} from 'expo';
import ActionButton from 'react-native-action-button';
import { Ionicons } from '@expo/vector-icons';
import Dimensions from 'Dimensions';
import {BASE} from '../Config/URLs';
import moment from "moment";

class LoginScreen extends Component {

    constructor(props) {
        super(props);
        this.state = {
            hasCameraPermission: null,
            botones:[
                {
                    id:1,
                    color:"#00ff00",
                    name:"Check-In",
                    icono:"md-checkmark",
                    estado:true,
                },
                {
                    id:0,
                    color:"#ff0000",
                    name:"Check-Out",
                    icono:"md-close",
                    estado:false,
                }
            ],
            activo:{
                id:1,
                color:"#00ff00",
                name:"Check-In",
                icono:"md-checkmark",
                estado:true,
            },
            modalVisible: false,
            respuesta:{
                val:'',
                mensaje:'',
            }
        };
        this.estadoActivo = this.estadoActivo.bind(this);
        this.showLogin=this.showLogin.bind(this);
        this.handleBarCodeScanned=this.handleBarCodeScanned.bind(this);
    }

    async componentWillMount() {
        const { status } = await Permissions.askAsync(Permissions.CAMERA);
        this.setState({ hasCameraPermission: status === 'granted' });
        BackHandler.addEventListener('hardwareBackPress', this.botonAtras);
        //this.estadoActivo();
    }

    componentWillUnmount() {
        BackHandler.removeEventListener('hardwareBackPress', this.botonAtras);
    }

    async handleBarCodeScanned(data,token) {
        if(this.state.modalVisible===false){
            this.setState({respuesta:{val:false,mensaje:"Processing",'icon':'md-clock','color':'#cce5ff'},modalVisible:true});
            if(data.data.length===8 && this.state.modalVisible===false){
                await fetch(BASE+'/api/tomar', {
                    method: 'POST',
                    headers: {
                        'Accept': 'application/json',
                        'Content-Type': 'application/json',
                        'Authorization' : 'Bearer '+token
                    },
                    body: JSON.stringify({
                        code: data.data,
                        date: moment().format('YYYY-MM-DD'),
                        time: moment().format('HH:mm:ss'),
                        type: this.state.activo.id,
                    }),
                }).then((response) => response.json())
                    .then((responseJson) => {
                        this.setState({respuesta:responseJson});
                        if(responseJson.val){
                            Vibration.vibrate([200]);
                        }else{
                            Vibration.vibrate([500,1000]);
                        }
                    }).catch(function(err) {
                        this.setState({respuesta:{val:false,mensaje:"Server error",'icon':'md-thumbs-down','color':'#f8d7da'}});
                });
            }else{
                Vibration.vibrate([500,500]);
                this.setState({respuesta:{val:false,mensaje:"QR code don't exist",'icon':'md-help','color':'#fff3cd'}});
            }
        }
    }

    botonAtras() {
        //ToastAndroid.show('', ToastAndroid.SHORT);
        return true;
    }

    estadoActivo(item){
        this.setState({activo:item});
        //this.setState({modalVisible: true});
    }

    showLogin(props){
        let { onLogin, onLogout, onUser, handleSubmit, auth } = props;
        if(auth.access_token === '') {
            return (
            <View style={styles.container} >
                <Text style={{fontWeight: 'bold',textAlign: 'center',width: '100%',fontSize:30,paddingBottom:20}}>
                    QR Attendan {}
                </Text>
                <Field style={styles.input} autoCapitalize="none" placeholder="Email" keyboardType="email-address" component={TInput} name={'email'} />
                <Field style={styles.input} autoCapitalize="none" placeholder="Password" secureTextEntry={true} component={TInput} name={'password'} />
                <View style={{flexDirection: 'row'}} >
                    <View style={{flexDirection: 'row',padding:12}} pointerEvents="none">
                        <Button
                            title="Register"
                            color="#982ef8"
                            style = {styles.button}
                            onPress={ ()=>{ Linking.openURL(BASE+'/register')}} />
                    </View>
                    <View style={{flexDirection: 'row',padding:12}} >
                        <Button
                            title = "Login"
                            color = "#236CF5"
                            style ={styles.button}
                            onPress = {handleSubmit(onLogin)}
                        />
                    </View>
                </View>

            </View>
            )
        } else {
            return (
                    <View style={styles.layouts} >
                        <View style={styles.layout1} >
                            <View style={{
                                width: '100%',
                                height: 50,
                                paddingTop:0,
                                paddingBottom:0,
                                paddingLeft:0,
                                paddingRight:0,backgroundColor:this.state.activo.color}}>
                                <Text style={{fontWeight: 'bold',textAlign: 'center',marginTop: 22,width: '100%'}}>
                                    {this.state.activo.name}
                                </Text>
                            </View>
                            <View style={styles.itemcontainer1} >
                                <View style={styles.itemcontainer1Inner} >
                                    <BarCodeScanner
                                        style={styles.item1}
                                        onBarCodeRead={(data) => this.handleBarCodeScanned(data,auth.access_token)}
                                    />
                                    <Modal
                                        animationType="fade"
                                        transparent={false}
                                        visible={this.state.modalVisible}
                                        onRequestClose={() => this.setState({modalVisible:false})}>
                                        <View style={{
                                            width: '100%',
                                            height: '98%',
                                            alignItems: 'center',
                                            justifyContent: 'center',
                                            overflow: 'hidden',
                                            borderStyle: 'solid',
                                            borderWidth: 0,
                                            flex: 1,
                                            position: 'relative',
                                            backgroundColor: this.state.respuesta.color
                                        }} >
                                            <Ionicons  name={this.state.respuesta.icon} style={{fontSize: 170,height: "50%",color: 'black'}} />
                                            <Text style={{fontSize:30,textAlign: 'center'}}>{this.state.respuesta.mensaje}</Text>
                                            <Button
                                                title = "Close"
                                                color = "#236CF5"
                                                style = {{backgroundColor:'#F8F8F8', paddingTop:20,width:'95%'}}
                                                onPress = {()=>this.setState({modalVisible:false})}
                                            />
                                        </View>
                                    </Modal>
                                    <ActionButton buttonColor='#000' >
                                        <ActionButton.Item buttonColor='#1abc9c' title="Sign Out" onPress={handleSubmit(onLogout)}>
                                            <Ionicons  name="md-exit" style={styles.actionButtonIcon} />
                                        </ActionButton.Item>
                                        <ActionButton.Item buttonColor={this.state.botones[0].color} title={this.state.botones[0].name} onPress={() =>this.estadoActivo(this.state.botones[0])}>
                                            <Ionicons  name={this.state.botones[0].icono} style={styles.actionButtonIcon} />
                                        </ActionButton.Item>
                                        <ActionButton.Item buttonColor={this.state.botones[1].color} title={this.state.botones[1].name} onPress={() =>this.estadoActivo(this.state.botones[1])}>
                                            <Ionicons  name={this.state.botones[1].icono} style={styles.actionButtonIcon} />
                                        </ActionButton.Item>
                                    </ActionButton>
                                </View>
                            </View>
                        </View>
                    </View>
                )
        }

    }
    render(){
        return this.showLogin(this.props)
   }
}

export default reduxForm({ form: 'login' })(LoginScreen);

const styles = StyleSheet.create({
    container: {
        flex:1,
        justifyContent:'center',
        alignItems:'center'
    },
    input:{
        height:40,
        width:300,
        padding:5,
        borderWidth:0,
        borderColor:'gray',
        margin:10
    },
    centerText: {
        flex: 1,
        fontSize: 18,
        padding: 32,
        color: '#777',
    },
    textBold: {
        fontWeight: '500',
        color: '#000',
    },
    buttonText: {
        fontSize: 21,
        color: 'rgb(0,122,255)',
    },
    buttonTouchable: {
        padding: 16,
    },
    button: {
        backgroundColor: 'blue',
        borderColor: 'white',
        borderWidth: 1,
        borderRadius: 12,
        color: 'white',
        fontSize: 24,
        fontWeight: 'bold',
        overflow: 'hidden',
        padding: 12,
        textAlign:'center',
    },
    component: {
        width: '100%',
        flexDirection: 'row',
        paddingLeft: 7.5,
        paddingRight: 7.5,
        paddingTop: 7.5,
        paddingBottom: 7.5,
    },

    layouts: {
        flexDirection: 'row',
        flexWrap: 'wrap',
    },

    layout1: {
        width: '100%',
        height: '100%',
    },

    itemcontainer1: {
        width: '100%',
        height: Dimensions.get('window').height-50,
        paddingTop:0,
        paddingBottom:0,
        paddingLeft:0,
        paddingRight:0,
    },

    itemcontainer1Inner: {
        width: '100%',
        height: '100%',
        position: 'relative',
        alignItems: 'center',
        justifyContent: 'center',
    },

    item1: {
        width: '100%',
        height: '98%',
        alignItems: 'center',
        justifyContent: 'center',
        overflow: 'hidden',
        borderStyle: 'solid',
        borderWidth: 0,
        flex: 1,
        position: 'relative'
    },
    actionButtonIcon: {
        fontSize: 20,
        height: 22,
        color: 'white'
    },
});
