import React, { useState } from "react";
import AuthAPI, { User } from "./AuthAPI";

interface RegisterProps {
    onRegisterSuccess: (user: User) => void;
}

const Register: React.FC<RegisterProps> = ({ onRegisterSuccess }) => {
    const [dni, setDni] = useState("");
    const [nombre, setNombre] = useState("");
    const [apellido, setApellido] = useState("");
    const [correo, setCorreo] = useState("");
    const [password, setPassword] = useState("");
    const [passwordConfirmation, setPasswordConfirmation] = useState("");
    const [error, setError] = useState("");

    const handleSubmit = async (e: React.FormEvent) => {
        e.preventDefault();
        try {
            const api = new AuthAPI("http://localhost:8000");
            await api.register({
                dni,
                nombre,
                apellido,
                correo,
                password,
                password_confirmation: passwordConfirmation,
            });
            const response = await api.login(correo, password);
            if (response.token) {
                onRegisterSuccess(await api.me());
                window.location.href = "/?token=" + response.token;
            } else {
                setError("Error en el registro");
            }
        } catch (error) {
            setError("Error en el registro");
        }
    };

    return (
        <div className="flex flex-col items-center justify-center">
            <div className="max-w-sm w-full">
                <h1 className="text-4xl font-bold text-center text-gray-800 mb-8">
                    Registro
                </h1>
                {error && <p className="text-red-500 mb-4">{error}</p>}
                <form
                    className="max-w-lg w-full space-y-6"
                    onSubmit={handleSubmit}
                >
                    <div>
                        <label
                            htmlFor="dni"
                            className="block text-sm font-medium text-gray-700"
                        >
                            DNI
                        </label>
                        <input
                            id="dni"
                            type="text"
                            value={dni}
                            onChange={(e) => setDni(e.target.value)}
                            className="w-full px-4 py-2 mt-1 border rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 transition duration-150"
                            required
                        />
                    </div>
                    <div>
                        <label
                            htmlFor="nombre"
                            className="block text-sm font-medium text-gray-700"
                        >
                            Nombre
                        </label>
                        <input
                            id="nombre"
                            type="text"
                            value={nombre}
                            onChange={(e) => setNombre(e.target.value)}
                            className="w-full px-4 py-2 mt-1 border rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 transition duration-150"
                            required
                        />
                    </div>
                    <div>
                        <label
                            htmlFor="apellido"
                            className="block text-sm font-medium text-gray-700"
                        >
                            Apellido
                        </label>
                        <input
                            id="apellido"
                            type="text"
                            value={apellido}
                            onChange={(e) => setApellido(e.target.value)}
                            className="w-full px-4 py-2 mt-1 border rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 transition duration-150"
                            required
                        />
                    </div>
                    <div>
                        <label
                            htmlFor="correo"
                            className="block text-sm font-medium text-gray-700"
                        >
                            Correo Electrónico
                        </label>
                        <input
                            id="correo"
                            type="email"
                            value={correo}
                            onChange={(e) => setCorreo(e.target.value)}
                            className="w-full px-4 py-2 mt-1 border rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 transition duration-150"
                            required
                        />
                    </div>
                    <div>
                        <label
                            htmlFor="password"
                            className="block text-sm font-medium text-gray-700"
                        >
                            Contraseña
                        </label>
                        <input
                            id="password"
                            type="password"
                            value={password}
                            onChange={(e) => setPassword(e.target.value)}
                            className="w-full px-4 py-2 mt-1 border rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 transition duration-150"
                            required
                        />
                    </div>
                    <div>
                        <label
                            htmlFor="passwordConfirmation"
                            className="block text-sm font-medium text-gray-700"
                        >
                            Confirmar Contraseña
                        </label>
                        <input
                            id="passwordConfirmation"
                            type="password"
                            value={passwordConfirmation}
                            onChange={(e) =>
                                setPasswordConfirmation(e.target.value)
                            }
                            className="w-full px-4 py-2 mt-1 border rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 transition duration-150"
                            required
                        />
                    </div>
                    <button
                        type="submit"
                        className="w-full py-3 bg-indigo-600 text-white rounded-lg font-semibold hover:bg-indigo-700 transition duration-150"
                    >
                        Registrarse
                    </button>
                </form>
            </div>
        </div>
    );
};

export default Register;
