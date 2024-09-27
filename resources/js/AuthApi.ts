import axios, { AxiosResponse } from 'axios';

export interface User {
    dni: string;
    nombre: string;
    apellido: string;
    correo: string;
    estado: boolean;
}

interface AuthResponse {
    message: string;
    user?: User;
    token: string;
}

interface LoginCredentials {
    correo: string;
    password: string;
}
    
interface RegisterData extends LoginCredentials {
    dni: string;
    nombre: string;
    apellido: string;
    password_confirmation: string;
}

class AuthAPI {
    private baseUrl: string;
    private token: string | null = null;

    constructor(baseUrl: string) {
        this.baseUrl = baseUrl;
    }

    async loginWithGoogle(): Promise<void> {
        window.location.href = `${this.baseUrl}google-login`;
    }

    async handleGoogleCallback(): Promise<AuthResponse> {
        const response = await this.handleRequest<AuthResponse>('get', 'google-callback');
        this.setToken(response.token);
        return response;
    }

    private setToken(token: string | null) {
        this.token = token;
        axios.defaults.headers.common['Authorization'] = token ? `Bearer ${token}` : '';
    }

    async login(credentials: LoginCredentials): Promise<AuthResponse> {
        const response = await this.handleRequest<AuthResponse>('post', 'api/auth/login', credentials);
        this.setToken(response.token);
        return response;
    }

    async register(data: RegisterData): Promise<AuthResponse> {
        const response = await this.handleRequest<AuthResponse>('post', 'api/auth/register', data);
        this.setToken(response.token);
        return response;
    }

    async getAuthenticatedUser(): Promise<User> {
        return await this.handleRequest<User>('get', 'api/auth/me');
    }

    async refreshToken(): Promise<AuthResponse> {
        const response = await this.handleRequest<AuthResponse>('post', 'api/auth/refresh');
        this.setToken(response.token);
        return response;
    }

    async logout(): Promise<void> {
        await this.handleRequest<void>('post', 'api/auth/logout');
        this.setToken(null);
    }

    async me(): Promise<User> {
        return await this.handleRequest<User>('get', 'api/auth/me');
    }

    private async handleRequest<T>(method: 'get' | 'post', endpoint: string, data?: any): Promise<T> {
        try {
            const response: AxiosResponse<T> = await axios[method](`${this.baseUrl}${endpoint}`, data);
            return response.data;
        } catch (error: any) {
            throw new Error(error.response?.data?.error || 'Error en la solicitud');
        }
    }
}

export default AuthAPI;