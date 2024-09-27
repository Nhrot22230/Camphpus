import React, { useEffect, useState } from "react";
import AuthAPI, { User } from "./AuthAPI";
import Login from "./Login";
import Register from "./Register";
import Home from "./Home";

const api = new AuthAPI("http://localhost:8000");

const App: React.FC = () => {
    const [user, setUser] = useState<User | null>(null);
    const [view, setView] = useState<"login" | "register" | "home">("login");

    const handleLogout = async () => {
        try {
            await api.logout();
            setUser(null);
            api.setToken("");
            setView("login");
            localStorage.removeItem("user");
            localStorage.removeItem("token");
        } catch (error) {
            console.error("Error al cerrar sesión:", error);
        }
    };
    

    const handleSuccess = (user: User) => {
        setUser(user);
        setView("home");
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
                let user = JSON.parse(
                    localStorage.getItem("user") || "null"
                ) as User | null;
                if (!user) {
                    user = (await api.me()) as User;
                    localStorage.setItem("user", JSON.stringify(user));
                }
                handleSuccess(user);
            } catch (error) {
                console.error("Error fetching user:", error);
                handleLogout();
            }
        };
        fetchData();
    }, []);

    return (
        <div className="flex flex-col items-center justify-center min-h-screen bg-gradient-to-r from-blue-500 to-purple-600 px-4 py-8">
            <div className="w-full max-w-md p-8 bg-white shadow-lg rounded-lg">
                {view === "login" && (
                    <Login onLoginSuccess={handleSuccess} api={api} />
                )}
                {view === "register" && (
                    <Register onRegisterSuccess={handleSuccess} api={api} />
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
