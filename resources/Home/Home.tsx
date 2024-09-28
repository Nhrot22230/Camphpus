import React from 'react';
import { User } from '../API/AuthAPI';

interface HomeProps {
  user: User | null;
  onLogout: () => void;
}

const Home: React.FC<HomeProps> = ({ user, onLogout }) => {
  const handleLogout = () => {
    onLogout();
  };

  return (
    <div className="flex items-center justify-center bg-gray-100">
      <div className="w-full max-w-md bg-white shadow-lg rounded-lg overflow-hidden">
        {user ? (
          <div className="p-6 text-center">
            <img 
              className="w-24 h-24 rounded-full mx-auto mb-4" 
              src={user.avatar || 'https://via.placeholder.com/150'} 
              alt="Avatar" 
            />
            <h2 className="text-2xl font-semibold text-gray-800">
              Bienvenido, {user.nombre} {user.apellido}
            </h2>
            <p className="text-gray-600 mt-2">Correo: {user.correo}</p>
            <p className="text-gray-600 mt-2">DNI: {user.dni}</p>
            <p className={`text-sm mt-2 ${user.estado ? 'text-green-500' : 'text-red-500'}`}>
              {user.estado ? 'Activo' : 'Inactivo'}
            </p>

            <button
              onClick={handleLogout}
              className="mt-6 bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600 transition-colors"
            >
              Cerrar sesión
            </button>
          </div>
        ) : (
          <p className="p-6 text-center text-gray-700">Cargando...</p>
        )}
      </div>
    </div>
  );
};

export default Home;
