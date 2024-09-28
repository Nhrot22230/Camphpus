import React, { useState } from "react";
import AuthAPI, { User } from "../API/AuthAPI";

interface RegisterProps {
    onRegisterSuccess: (user: User) => void;
    api: AuthAPI;
}

const Register: React.FC<RegisterProps> = ({ onRegisterSuccess, api }) => {
    const [dni, setDni] = useState("");
    const [nombre, setNombre] = useState("");
    const [apellido, setApellido] = useState("");
    const [correo, setCorreo] = useState("");
    const [password, setPassword] = useState("");
    const [passwordConfirmation, setPasswordConfirmation] = useState("");
    const [error, setError] = useState("");

    const handleDniChange = (e: any) => setDni(e.target.value);
    const handleNombreChange = (e: any) => setNombre(e.target.value);
    const handleApellidoChange = (e: any) => setApellido(e.target.value);
    const handleCorreoChange = (e: any) => setCorreo(e.target.value);
    const handlePasswordChange = (e: any) => setPassword(e.target.value);
    const handlePasswordConfirmationChange = (e: any) =>
        setPasswordConfirmation(e.target.value);

    const handleSubmit = async (e: React.FormEvent) => {
        e.preventDefault();
        if (password !== passwordConfirmation) {
            setError("Las contraseñas no coinciden");
            setTimeout(() => {
                setError("");
            }
            , 2500);
            return;
        }

        try {
            await api.register({
                dni,
                nombre,
                apellido,
                correo,
                password,
                password_confirmation: passwordConfirmation,
            });

            const { token } = await api.login(correo, password);
            if (!token) {
                setError("Error en el registro");
                return;
            }

            const user = await api.me();
            localStorage.setItem("user", JSON.stringify(user));
            localStorage.setItem("token", token);
            onRegisterSuccess(user);
            window.location.reload();
        } catch (error) {
            setError(
                "Error en el registro. Por favor, revisa los datos ingresados."
            );
        }
    };

    return (
        <div className="flex flex-col items-center justify-center">
            <div className="w-full px-10">
                {error && (
                    <p className="text-red-500 mb-4 text-center">{error}</p>
                )}
                <form className="w-full py-2" onSubmit={handleSubmit}>
                    <div className="mb-4">
                        <md-outlined-text-field
                            id="dni"
                            label="DNI"
                            type="text"
                            value={dni}
                            onInput={handleDniChange}
                            required
                            class="w-full"
                        ></md-outlined-text-field>
                    </div>

                    <div className="mb-4">
                        <md-outlined-text-field
                            id="nombre"
                            label="Nombre"
                            type="text"
                            value={nombre}
                            onInput={handleNombreChange}
                            required
                            class="w-full"
                        ></md-outlined-text-field>
                    </div>

                    <div className="mb-4">
                        <md-outlined-text-field
                            id="apellido"
                            label="Apellido"
                            type="text"
                            value={apellido}
                            onInput={handleApellidoChange}
                            required
                            class="w-full"
                        ></md-outlined-text-field>
                    </div>

                    <div className="mb-4">
                        <md-outlined-text-field
                            id="correo"
                            label="Correo Electrónico"
                            type="email"
                            value={correo}
                            onInput={handleCorreoChange}
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
                            onInput={handlePasswordChange}
                            required
                            class="w-full"
                        ></md-outlined-text-field>
                    </div>

                    <div className="mb-4">
                        <md-outlined-text-field
                            id="passwordConfirmation"
                            label="Confirmar Contraseña"
                            type="password"
                            value={passwordConfirmation}
                            onInput={handlePasswordConfirmationChange}
                            required
                            class="w-full"
                        ></md-outlined-text-field>
                    </div>

                    <button
                        type="submit"
                        className="hover:bg-blue-700 text-white w-full py-2 rounded focus:outline-none focus:shadow-outline"
                        style={{ backgroundColor: "#112F45" }}
                    >
                        Registrarse
                    </button>
                </form>
            </div>
        </div>
    );
};

export default Register;
