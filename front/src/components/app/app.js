import React, {Component} from 'react';
import {HashRouter, Link, Route, Routes} from "react-router-dom";
import {RatesPage} from "../pages";
import Header from "../header";
import Api from "../../services/Api";
import {ApiServiceProvider} from '../service-context'
import WelcomePage from "../pages/welcome-page";

export default class App extends Component {

    state = {
        apiService: new Api(),
        hasError: false,
    }

    render() {
        return (
            <ApiServiceProvider value={this.state.apiService}>
                <HashRouter>
                    <div>
                        <Header/>

                        <Routes>
                            <Route path="/" element={<WelcomePage/>}/>
                            <Route path="wallets/:currency" element={<RatesPage />}/>
                         />
                        </Routes>
                    </div>
                </HashRouter>
            </ApiServiceProvider>
        )
    }
}
