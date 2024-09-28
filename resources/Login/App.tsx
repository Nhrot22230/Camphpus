import React, { useEffect, useState } from "react";
import AuthAPI, { User } from "../API/AuthAPI";
import Login from "./Login";
import Register from "./Register";

const api = new AuthAPI("http://localhost:8000");

const App: React.FC = () => {
    const [view, setView] = useState<"login" | "register">("login");

    const handleSuccess = (user: User) => {
        localStorage.setItem("user", JSON.stringify(user));
        localStorage.setItem("token", api.getToken() || "");
        window.history.replaceState({}, document.title, "/home");
        window.location.reload();
    };

    useEffect(() => {
        const fetchData = async () => {
            try {
                const tokenFromUrl = new URLSearchParams(
                    window.location.search
                ).get("token");
                const token = tokenFromUrl || localStorage.getItem("token");
                if (tokenFromUrl) {
                    localStorage.setItem("token", tokenFromUrl);
                    window.history.replaceState({}, document.title, "/");
                }

                if (!token) return;
                api.setToken(token);
                let storedUser = localStorage.getItem("user");
                let user = storedUser ? (JSON.parse(storedUser) as User) : null;

                if (!user) {
                    user = await api.me();
                    localStorage.setItem("user", JSON.stringify(user));
                }

                handleSuccess(user);
            } catch (error) {
                console.error("Error al obtener el usuario:", error);
            }
        };

        fetchData();
    }, []);

    return (
        <div className="flex h-screen">
            <div
                className="w-2/3 bg-cover"
                style={{
                    backgroundImage: `url('http://localhost:8000/img/bg_login.jpeg')`,
                }}
            />
            <div className="w-1/3 flex-col flex justify-center text-center">
                <img
                    src="http://localhost:8000/img/pucp-logo.png"
                    alt="Logo"
                    className="px-20 mb-8"
                />
                {view === "login" ? (
                    <Login onLoginSuccess={handleSuccess} api={api} />
                ) : (
                    <Register onRegisterSuccess={handleSuccess} api={api} />
                )}
                <p className="text-gray-700 py-2">
                    {view === "login"
                        ? "¿No tienes una cuenta?"
                        : "¿Ya tienes una cuenta?"}
                    <button
                        className="text-blue-600 font-semibold hover:underline ml-1"
                        onClick={() =>
                            setView(view === "login" ? "register" : "login")
                        }
                    >
                        {view === "login"
                            ? "Regístrate aquí"
                            : "Inicia sesión aquí"}
                    </button>
                </p>
            </div>
        </div>
    );
};

export default App;
