import React, { useEffect, useState } from "react";
import AuthAPI, { User } from "../API/AuthAPI";

interface LoginProps {
    onLoginSuccess: (user: User) => void;
    api: AuthAPI;
}

const Login: React.FC<LoginProps> = ({ onLoginSuccess, api }) => {
    const [correo, setCorreo] = useState("");
    const [password, setPassword] = useState("");
    const [error, setError] = useState("");

    const handleSubmit = async (e: React.FormEvent) => {
        e.preventDefault();

        try {
            const { token } = await api.login(correo, password);

            if (!token) {
                setError("Credenciales inválidas");
                return;
            }

            const user = (await api.me()) as User;
            localStorage.setItem("user", JSON.stringify(user));
            localStorage.setItem("token", token);
            onLoginSuccess(user);
            window.location.reload();
        } catch (error) {
            setError(
                "Error al iniciar sesión. Por favor, revisa tus credenciales."
            );
        }
    };

    return (
        <div className="flex flex-col items-center justify-center">
            <div className="w-full px-10">
                {error && (
                    <p className="text-red-500 mb-4 text-center">{error}</p>
                )}

                <form
                    className="w-full py-2"
                    onSubmit={handleSubmit}
                >
                    <div className="mb-4">
                        <md-outlined-text-field
                            id="correo"
                            label="Correo"
                            type="email"
                            value={correo}
                            oninput={(e: any) => setCorreo(e.target.value)}
                            required
                            class="w-full"
                        ></md-outlined-text-field>
                    </div>

                    <div className="mb-4">
                        <md-outlined-text-field
                            id="password"
                            label="Contraseña"
                            type="password"
                            value={password}
                            oninput={(e: any) => setPassword(e.target.value)}
                            required
                            class="w-full"
                        ></md-outlined-text-field>
                    </div>

                    <button
                        type="submit"
                        className="hover:bg-blue-700 text-white w-full py-2 rounded focus:outline-none focus:shadow-outline"
                        style={{ backgroundColor: "#112F45" }}
                    >
                        Iniciar sesión
                    </button>
                </form>
                <p className="w-full text-center text-gray-500">o</p>
                <a
                    href="/auth/redirect/google"
                >
                    <div className="flex items-center justify-center gap-2 bg-white border border-gray-300 rounded-lg p-2 hover:bg-gray-100 transition duration-200">
                        <img
                            src="https://cdn1.iconfinder.com/data/icons/google-s-logo/150/Google_Icons-09-512.png"
                            alt="Google logo"
                            className="h-6"
                        />
                        <span className="text-gray-500">Iniciar sesión con Google</span>
                    </div>
                </a>
            </div>
        </div>
    );
};

export default Login;
