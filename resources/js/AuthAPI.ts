// AuthAPI.ts
import axios, { AxiosInstance } from "axios";

export interface User {
    idUsuario: number;
    dni: string;
    nombre: string;
    apellido: string;
    correo: string;
    estado: boolean;
    avatar?: string;
    external_id?: string;
    external_auth?: string;
    // otros campos según sea necesario
}

export default class AuthAPI {
    private api: AxiosInstance;
    private token: string | null;

    constructor(baseURL: string) {
        this.api = axios.create({
            baseURL: baseURL,
        });

        this.token = null;

        // Interceptor para agregar el token en cada solicitud
        this.api.interceptors.request.use(
            (config) => {
                if (this.token) {
                    config.headers["Authorization"] = `Bearer ${this.token}`;
                }
                return config;
            },
            (error) => {
                return Promise.reject(error);
            }
        );
    }

    // Método para registrar un nuevo usuario
    public async register(data: {
        dni: string;
        nombre: string;
        apellido: string;
        correo: string;
        password: string;
        password_confirmation: string;
    }): Promise<{ message: string; user: User; token: string }> {
        const response = await this.api.post("/api/auth/register", data);
        this.token = response.data.token;
        return response.data;
    }

    // Método para iniciar sesión
    public async login(
        correo: string,
        password: string
    ): Promise<{ message: string; token: string }> {
        const response = await this.api.post("/api/auth/login", {
            correo,
            password,
        });
        this.token = response.data.token;
        return response.data;
    }

    // Método para cerrar sesión
    public async logout(): Promise<{ message: string }> {
        const response = await this.api.post("/api/auth/logout");
        this.token = null;
        return response.data;
    }

    // Método para obtener los datos del usuario autenticado
    public async me(): Promise<User> {
        const response = await this.api.get("/api/auth/me");
        return response.data;
    }

    // Método para actualizar el token JWT
    public async refresh(): Promise<{ message: string; token: string }> {
        const response = await this.api.post("/api/auth/refresh");
        this.token = response.data.token;
        return response.data;
    }

    // Obtener el token actual
    public getToken(): string | null {
        return this.token;
    }

    // Establecer el token manualmente
    public setToken(token: string): void {
        this.token = token;
    }
}
