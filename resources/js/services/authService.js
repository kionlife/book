import axios from "axios";

const API_URL = "/api";

const authService = {
    async login(email, password) {
        try {
            const response = await axios.post('/api/login', {
                email,
                password,
                withCredentials: true
            });

            return {
                access_token: response.data.access_token,
                user: response.data.user,
            };
        } catch (error) {
            throw error;
        }
    },

    async getUser() {
        try {
            const response = await axios.get(`${API_URL}/user`, {
                headers: {
                    "Authorization": `Bearer ${localStorage.getItem("access_token")}`,
                },
            });
            return response.data;
        } catch (error) {
            console.error("Error fetching user data:", error);
            throw error;
        }
    },

    // New method for requesting a password reset
    async requestPasswordReset(email) {
        try {
            const response = await axios.post(`${API_URL}/password-reset-request`, {
                email,
            });
            return response.data;
        } catch (error) {
            throw error;
        }
    },

    // New method for resetting the password with a provided token
    async resetPassword(email, password, password_confirmation, token) {
        try {
            const response = await axios.post('/api/password-reset', {
                email,
                password,
                password_confirmation,
                token
            });
            return response.data;
        } catch (error) {
            throw error;
        }
    }

};

export default authService;
