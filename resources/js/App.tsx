import React, { useState } from 'react';
import Login from './Login';
import Logout from './Logout';
import Register from './Register';
import { User } from './AuthApi';

const App: React.FC = () => {
  const [isAuthenticated, setIsAuthenticated] = useState<boolean>(false);
  const [showRegister, setShowRegister] = useState<boolean>(false);
  const [user, setUser] = useState<User | null>(null);
  
  const handleLoginSuccess = (user: User) => {
    setUser(user);  
    setIsAuthenticated(true);
  };

  const handleRegisterSuccess = () => {
    setIsAuthenticated(true);
  };

  const handleLogout = () => {
    setIsAuthenticated(false);
  };

  return (
    <div className="min-h-screen flex flex-col items-center justify-center bg-gray-100">
      {isAuthenticated ? (
        <div>
          <h1 className="text-2xl font-bold mb-4">Bienvenido</h1>
          <p className="mb-4">Hola, {user?.nombre} {user?.apellido}</p>
          <Logout onLogout={handleLogout} />
        </div>
      ) : (
        <div>
          {showRegister ? (
            <>
              <Register onRegisterSuccess={handleRegisterSuccess} />
              <p className="mt-4">
                ¿Ya tienes cuenta?{' '}
                <button
                  className="text-blue-500 hover:underline"
                  onClick={() => setShowRegister(false)}
                >
                  Inicia sesión aquí
                </button>
              </p>
            </>
          ) : (
            <>
              <Login onLoginSuccess={handleLoginSuccess} />
              <p className="mt-4">
                ¿No tienes cuenta?{' '}
                <button
                  className="text-blue-500 hover:underline"
                  onClick={() => setShowRegister(true)}
                >
                  Regístrate aquí
                </button>
              </p>
            </>
          )}
        </div>
      )}
    </div>
  );
}



export default App;