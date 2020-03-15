import React, { Component } from 'react';
import ReactDOM from 'react-dom';
import { BrowserRouter, Route, Switch, Link} from 'react-router-dom';
import About from './About';
import Home from './Home';


export default class App extends Component {
    render() {
        return (
            <BrowserRouter>
                <nav>
                    <ul>
                        <li><Link to="/about">About</Link></li>
                        <li><Link to="/">Home</Link></li>
                    </ul>
                </nav>
                <Switch>
                    <Route path="/" exact component={Home}/>
                    <Route path="/about" component={About}/>
                </Switch>
            </BrowserRouter>
        );
    }
}

ReactDOM.render(<App />, document.getElementById('app'));