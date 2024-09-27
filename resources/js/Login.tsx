import React, { useState } from "react";
import AuthAPI, { User } from "./AuthAPI";

interface LoginProps {
    onLoginSuccess: (user: User) => void;
}

const Login: React.FC<LoginProps> = ({ onLoginSuccess }) => {
    const [correo, setCorreo] = useState("");
    const [password, setPassword] = useState("");
    const [error, setError] = useState("");

    const handleSubmit = async (e: React.FormEvent) => {
        e.preventDefault();
        try {
            const api = new AuthAPI("http://localhost:8000");
            const response = await api.login(correo, password);
            if (response.token) {
                onLoginSuccess(await api.me());
                window.location.href = "/?token=" + response.token;
            } else {
                setError("Credenciales inválidas");
            }
        } catch (error) {
            setError("Credenciales inválidas");
        }
    };

    return (
        <div className="flex flex-col items-center justify-center">
            <div className="max-w-sm w-full">
                <h1 className="text-3xl font-bold mb-6 text-center text-gray-800">
                    Iniciar sesión
                </h1>

                {error && (
                    <p className="text-red-500 mb-4 text-center">{error}</p>
                )}

                <form onSubmit={handleSubmit}>
                    <div className="mb-4">
                        <label
                            htmlFor="correo"
                            className="block mb-2 text-sm font-medium text-gray-600"
                        >
                            Correo
                        </label>
                        <input
                            id="correo"
                            type="email"
                            value={correo}
                            onChange={(e) => setCorreo(e.target.value)}
                            className="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                            required
                        />
                    </div>
                    <div className="mb-4">
                        <label
                            htmlFor="password"
                            className="block mb-2 text-sm font-medium text-gray-600"
                        >
                            Contraseña
                        </label>
                        <input
                            id="password"
                            type="password"
                            value={password}
                            onChange={(e) => setPassword(e.target.value)}
                            className="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                            required
                        />
                    </div>

                    <button
                        type="submit"
                        className="w-full px-4 py-2 text-white bg-blue-500 rounded-lg hover:bg-blue-600 transition duration-200"
                    >
                        Iniciar sesión
                    </button>

                    <div className="mt-4 text-center">
                        <a
                            href="/auth/redirect/google"
                            className="text-red-500 hover:underline"
                        >
                            Iniciar sesión con Google
                        </a>
                    </div>
                </form>
            </div>
        </div>
    );
};

export default Login;
