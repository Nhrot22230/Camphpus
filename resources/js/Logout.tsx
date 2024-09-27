import React from 'react';
import AuthAPI from './AuthApi'; // Asegúrate de importar el consumidor de la API

interface LogoutProps {
    onLogout: () => void;
}

const Logout: React.FC<LogoutProps> = ({ onLogout }) => {
    const api = new AuthAPI('http://localhost:8000/');

    const handleLogout = async () => {
        try {
            await api.logout();
            onLogout(); // Llamar la función de éxito en el logout
        } catch (error) {
            console.error('Error al cerrar la sesión', error);
        }
    };

    return (
        <button
            onClick={handleLogout}
            className="bg-red-500 text-white py-2 px-4 rounded-lg hover:bg-red-600 transition duration-300"
        >
            Cerrar Sesión
        </button>
    );
};

export default Logout;