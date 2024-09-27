import React, { useEffect, useState } from "react";
import AuthAPI, { User } from "./AuthAPI";
import Login from "./Login";
import Register from "./Register";
import Home from "./Home";

// Inicializamos la instancia de AuthAPI una sola vez
const api = new AuthAPI("http://localhost:8000");

const App: React.FC = () => {
    const [user, setUser] = useState<User | null>(null);
    const [view, setView] = useState<"login" | "register" | "home">("login");

    useEffect(() => {
        const token = new URLSearchParams(window.location.search).get("token");
        if (token) {
            api.setToken(token);
            api.me()
                .then((userData) => {
                    setUser(userData);
                    setView("home"); // Cambia a la vista de Home si hay un usuario
                })
                .catch((error) => {
                    console.error("Error fetching user:", error);
                });

            // Limpia la URL eliminando el token de la query string
            window.history.replaceState({}, document.title, "/");
        }
    }, []);

    const handleLogout = () => {
        api.logout();
        setUser(null);
        setView("login");
    };

    const handleSuccess = (user: User) => {
        setUser(user);
        setView("home");
    };

    return (
        <div className="flex flex-col items-center justify-center min-h-screen bg-gradient-to-r from-blue-500 to-purple-600 px-4 py-8">
            <div className="w-full max-w-md p-8 bg-white shadow-lg rounded-lg">
                {/* Renderiza los componentes según la vista */}
                {view === "login" && <Login onLoginSuccess={handleSuccess} />}
                {view === "register" && (
                    <Register onRegisterSuccess={handleSuccess} />
                )}
                {view === "home" && (
                    <Home user={user} onLogout={handleLogout} />
                )}

                <div className="mt-6 text-center">
                    {view === "login" && (
                        <p className="text-gray-700">
                            ¿No tienes una cuenta?
                            <button
                                className="text-blue-600 font-semibold hover:underline ml-1"
                                onClick={() => setView("register")}
                            >
                                Regístrate aquí
                            </button>
                        </p>
                    )}
                    {view === "register" && (
                        <p className="text-gray-700">
                            ¿Ya tienes una cuenta?
                            <button
                                className="text-blue-600 font-semibold hover:underline ml-1"
                                onClick={() => setView("login")}
                            >
                                Inicia sesión aquí
                            </button>
                        </p>
                    )}
                </div>
            </div>
        </div>
    );
};

export default App;
