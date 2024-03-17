import React from 'react';
import {Link} from "react-router-dom";

const Header = () => {
    return (
        <div>
            <nav className="navbar navbar-expand-lg navbar-dark bg-dark">
                <Link className="navbar-brand" to="/">Home</Link>
                <Link className="navbar-brand" to="/wallets/GBP">GBP</Link>
                <Link className="navbar-brand" to="/wallets/USD">USD</Link>
                <Link className="navbar-brand" to="/wallets/AUD">AUD</Link>
            </nav>
        </div>
    )
}

export default Header;
