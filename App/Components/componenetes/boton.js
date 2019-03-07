import React , {Component} from 'react';
import { Ionicons } from '@expo/vector-icons';
import ActionButton from "react-native-action-button";
export default class boton extends Component{
    render() {
        return (
            <ActionButton.Item buttonColor='#1abc9c' title="Sign Out" onPress={() => {}}>
                <Ionicons  name="md-exit" style={{fontSize: 20,
                    height: 22,
                    color: 'white'}} />
            </ActionButton.Item>
        );
    }
}
module.export=boton;
