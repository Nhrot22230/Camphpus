import React from 'react';
import ReactDOM from 'react-dom/client';
import App from './App';
import '../css/app.css';

const rootElement = document.getElementById('app');
if (rootElement) {
    const root = ReactDOM.createRoot(rootElement);
    root.render(<App />);
}