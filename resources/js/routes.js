import Login from "./components/auth/Login";
import Register from "./components/auth/Register";
import Home from "./components/admin/Home";
import Logout from "./components/auth/Logout";

export const routes = [
    {path: '/', component: Login, name: '/'},
    {path: '/register', component: Register, name: 'register'},
    {path: '/logout', component: Logout, name: 'logout'},
    {path: '/home', component: Home, name: 'home'}
]
