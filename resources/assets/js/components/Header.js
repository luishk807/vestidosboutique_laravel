import React,{ useState } from 'react'
import { Link, BrowserRouter as Router } from 'react-router-dom';

const Header = props=>{
    
    const [currName, changeName] = useState("luis");

    return (
        <Router>
            <nav>
                <ul>
                    <li><Link to="/about">About</Link></li>
                    <li><Link to="/">Home</Link></li>
                </ul>
            </nav>
        </Router>

    )
}

export default Header;
 