import React, { Component } from 'react';
import ReactDOM from 'react-dom';
import Header from './Header';
import About from './About';
import Home from './Home';
import { BrowserRouter, Route } from 'react-router-dom';

export default class App extends Component {
    render() {
        return (
            <React.Fragment>
                <Header/>
                <BrowserRouter>
                    <Route path="/" component={Home}/>
                    <Route path="/about" component={About}/>
                </BrowserRouter>
            </React.Fragment>
        );
    }
}

ReactDOM.render(<App />, document.getElementById('app'));