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
}

export default class AuthAPI {
    private api: AxiosInstance;
    private token: string | null;

    constructor(baseURL: string) {
        this.api = axios.create({
            baseURL: baseURL,
        });

        this.token = null;

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

    public async logout(): Promise<{ message: string }> {
        const response = await this.api.post("/api/auth/logout");
        this.token = null;
        return response.data;
    }

    public async me(): Promise<User> {
        const response = await this.api.get("/api/auth/me");
        return response.data;
    }

    public async refresh(): Promise<{ message: string; token: string }> {
        const response = await this.api.post("/api/auth/refresh");
        this.token = response.data.token;
        return response.data;
    }

    public getToken(): string | null {
        return this.token;
    }

    public setToken(token: string): void {
        this.token = token;
    }

    public removeToken(): void {
        this.token = null;
    }

    public isLoggedIn(): boolean {
        return this.token !== null;
    }

    public async listUsers(): Promise<User[]> {
        const response = await this.api.get("/api/usuarios");
        return response.data;
    }

    public async getUser(id: number): Promise<User> {
        const response = await this.api.get(`/api/usuarios/${id}`);
        return response.data;
    }

    public async createUser(data: {
        dni: string;
        nombre: string;
        apellido: string;
        correo: string;
        password: string;
        estado: boolean;
    }): Promise<User> {
        const response = await this.api.post("/api/usuarios", data);
        return response.data;
    }

    public async updateUser(id: number, data: {
        dni: string;
        nombre: string;
        apellido: string;
        correo: string;
        password?: string;
        estado: boolean;
    }): Promise<User> {
        const response = await this.api.put(`/api/usuarios/${id}`, data);
        return response.data;
    }

    public async deleteUser(id: number): Promise<{ message: string }> {
        const response = await this.api.delete(`/api/usuarios/${id}`);
        return response.data;
    }

    
}