import React, { useState, useEffect } from 'react';
import axios from 'axios';

const URL_BASE = 'http://localhost:8000';
const API_URL = `${URL_BASE}/api/usuarios`;

interface Usuario {
  idUsuario: number;
  dni: string;
  nombre: string;
  apellido: string;
  password: string;
  correo: string;
  estado: boolean;
}

interface FormData {
  dni: string;
  nombre: string;
  apellido: string;
  password: string;
  correo: string;
  estado: boolean;
}

type FormField = keyof FormData;

const Usuarios: React.FC = () => {
  const [usuarios, setUsuarios] = useState<Usuario[]>([]);
  const [formData, setFormData] = useState<FormData>({
    dni: '',
    nombre: '',
    apellido: '',
    correo: '',
    password: '',
    estado: true,
  });
  const [isEditing, setIsEditing] = useState<boolean>(false);
  const [currentId, setCurrentId] = useState<number | null>(null);

  // Obtener la lista de usuarios al cargar el componente
  useEffect(() => {
    fetchUsuarios();
  }, []);

  const fetchUsuarios = async () => {
    try {
      const response = await axios.get<Usuario[]>(API_URL);
      setUsuarios(response.data);
    } catch (error) {
      console.error('Error al obtener usuarios:', error);
    }
  };

  const handleChange = (e: React.ChangeEvent<HTMLInputElement | HTMLSelectElement>) => {
    const { name, value } = e.target;
    const fieldName = name as FormField;

    setFormData((prevData) => ({
      ...prevData,
      [fieldName]: fieldName === 'estado' ? value === 'true' : value,
    }));
  };

  const handleSubmit = async (e: React.FormEvent<HTMLFormElement>) => {
    e.preventDefault();

    try {
      if (isEditing && currentId !== null) {
        await axios.put(`/api/usuarios/${currentId}`, formData);
      } else {
        console.log('formData:', formData);
        await axios.post('/api/usuarios', formData);
      }
      setFormData({
        dni: '',
        nombre: '',
        apellido: '',
        password: '',
        correo: '',
        estado: true,
      });
      setIsEditing(false);
      setCurrentId(null);
      fetchUsuarios();
    } catch (error) {
      console.error('Error al guardar el usuario:', error);
    }
  };

  const handleEdit = (usuario: Usuario) => {
    setIsEditing(true);
    setCurrentId(usuario.idUsuario);
    setFormData({
      dni: usuario.dni,
      nombre: usuario.nombre,
      apellido: usuario.apellido,
      password: usuario.password,
      correo: usuario.correo,
      estado: usuario.estado,
    });
  };

  const handleDelete = async (id: number) => {
    try {
      await axios.delete(`/api/usuarios/${id}`);
      fetchUsuarios();
    } catch (error) {
      console.error('Error al eliminar el usuario:', error);
    }
  };

  return (
    <div>
      <h1>Gestión de Usuarios</h1>
      <form onSubmit={handleSubmit}>
        <div>
          <label>DNI:</label>
          <input
            type="text"
            name="dni"
            value={formData.dni}
            onChange={handleChange}
            required
          />
        </div>
        <div>
          <label>Nombre:</label>
          <input
            type="text"
            name="nombre"
            value={formData.nombre}
            onChange={handleChange}
            required
          />
        </div>
        <div>
          <label>Apellido:</label>
          <input
            type="text"
            name="apellido"
            value={formData.apellido}
            onChange={handleChange}
            required
          />
        </div>
        <div>
          <label>Correo:</label>
          <input
            type="email"
            name="correo"
            value={formData.correo}
            onChange={handleChange}
            required
          />
        </div>
        <div>
            <label>Contraseña:</label>
            <input
                type="password"
                name="password"
                value={formData.password}
                onChange={handleChange}
                required
            />
        </div>
        <div>
          <label>Estado:</label>
          <select
            name="estado"
            value={formData.estado ? 'true' : 'false'}
            onChange={handleChange}
          >
            <option value="true">Activo</option>
            <option value="false">Inactivo</option>
          </select>
        </div>
        <button type="submit">{isEditing ? 'Actualizar' : 'Crear'}</button>
      </form>

      <h2>Lista de Usuarios</h2>
      <table>
        <thead>
          <tr>
            <th>DNI</th>
            <th>Nombre Completo</th>
            <th>Correo</th>
            <th>Estado</th>
            <th>Acciones</th>
          </tr>
        </thead>
        <tbody>
          {usuarios.map((usuario) => (
            <tr key={usuario.idUsuario}>
              <td>{usuario.dni}</td>
              <td>
                {usuario.nombre} {usuario.apellido}
              </td>
              <td>{usuario.correo}</td>
              <td>{usuario.estado ? 'Activo' : 'Inactivo'}</td>
              <td>
                <button onClick={() => handleEdit(usuario)}>Editar</button>
                <button onClick={() => handleDelete(usuario.idUsuario)}>Eliminar</button>
              </td>
            </tr>
          ))}
        </tbody>
      </table>
    </div>
  );
};

export default Usuarios;
