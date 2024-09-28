import React, { useEffect, useState } from "react";
import AuthAPI, { User } from "../API/AuthAPI";
import Home from "./Home";

const api = new AuthAPI("http://localhost:8000");

const App: React.FC = () => {
    const [user, setUser] = useState<User | null>(null);

    const handleLogout = async () => {
        try {
            await api.logout();
            setUser(null);
            api.removeToken();
            localStorage.removeItem("user");
            localStorage.removeItem("token");
            window.location.href = "/";
        } catch (error) {
            console.error("Error al cerrar sesión:", error);
        }
    };

    const handleSuccess = (user: User) => {
        setUser(user);
        localStorage.setItem("user", JSON.stringify(user));
        localStorage.setItem("token", api.getToken() || "");
    };

    useEffect(() => {
        const fetchData = async () => {
            try {
                const tokenFromUrl = new URLSearchParams(window.location.search).get("token");
                const token = tokenFromUrl || localStorage.getItem("token");
                
                if (tokenFromUrl) {
                    localStorage.setItem("token", tokenFromUrl);
                }

                if (!token) {
                    window.location.href = "/";
                    return;
                }

                api.setToken(token);

                let storedUser = localStorage.getItem("user");
                let user = storedUser ? (JSON.parse(storedUser) as User) : null;

                if (!user) {
                    user = await api.me();
                    localStorage.setItem("user", JSON.stringify(user));
                }

                handleSuccess(user);
                window.history.replaceState({}, document.title, "/home");
            } catch (error) {
                console.error("Error al obtener el usuario:", error);
                handleLogout();
            }
        };
        fetchData();
    }, []);

    return (
        <div>
            <h1 className="text-2xl font-semibold text-gray-800 text-center mt-8">
                Bienvenido a la plataforma de administración de usuarios
            </h1>
            <Home user={user} onLogout={handleLogout} />
        </div>
    );
};

export default App;
