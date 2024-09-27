import React, { useEffect } from 'react';
// import { useNavigate } from 'react-router-dom';
import AuthAPI from './AuthApi';

const GoogleCallback: React.FC = () => {
    const api = new AuthAPI('http://localhost:8000/api');
    //const navigate = useNavigate();

    useEffect(() => {
        async function handleGoogleAuth() {
            try {
                const response = await api.handleGoogleCallback();
                //navigate('/dashboard');
            } catch (error) {
                console.error('Error during Google authentication:', error);
                //navigate('/login');
            }
        }
        handleGoogleAuth();
    }, []);

    return <div>Procesando autenticación con Google...</div>;
};

export default GoogleCallback;
