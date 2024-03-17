import React from 'react';

import './error-indicator.css';
import icon from './error.png';

const ErrorIndicator = () => {
  return (
    <div className="error-indicator">
      <img src={icon} alt="error icon"/>
      <span className="boom">OUCH!</span>
      <span>
        something has gone terribly wrong
      </span>
      <span>
        (but we already fixing it)
      </span>
    </div>
  );
};

export default ErrorIndicator;
