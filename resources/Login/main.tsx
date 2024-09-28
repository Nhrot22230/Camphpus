import React from "react";
import ReactDOM from "react-dom/client";
import App from "./App"
import '../styles/app.css';
import "@material/web/checkbox/checkbox.js";
import "@material/web/button/outlined-button.js";
import "@material/web/button/filled-button.js";
import "@material/web/textfield/filled-text-field.js";
import "@material/web/textfield/outlined-text-field.js";

declare global {
    namespace JSX {
        interface IntrinsicElements {
            "md-checkbox": any;
            "md-outlined-button": any;
            "md-filled-button": any;
            "md-outlined-text-field": any;
            "md-filled-text-field": any;
        }
    }
}

const root = ReactDOM.createRoot(document.getElementById('app')!);

root.render(
    <React.StrictMode>
        <App />
    </React.StrictMode>
)