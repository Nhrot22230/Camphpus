import React from 'react';
import ReactDOM from 'react-dom/client';
import Usuarios from './usuarios';

const App: React.FC = () => {
    return (
        <div>
            <h1>¡Hola, React con TypeScript en Laravel!</h1>
            <Usuarios />
        </div>
    );
}

const rootElement = document.getElementById('app');
if (rootElement) {
    const root = ReactDOM.createRoot(rootElement);
    root.render(<App />);
}
