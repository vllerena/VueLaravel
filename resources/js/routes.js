import Login from "./components/auth/Login";
import Register from "./components/auth/Register";

export const routes = [
    { path: '/', component: Login, name: '/'},
    { path: '/register', component: Register, name: 'register'}
]
