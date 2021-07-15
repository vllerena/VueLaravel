import Login from "./components/auth/Login";
import Register from "./components/auth/Register";
import Home from "./components/admin/Home";
import Logout from "./components/auth/Logout";
import CreateEmployee from "./components/employee/Create";
import IndexEmployee from "./components/employee/Index";
import EditEmployee from "./components/employee/Edit"

export const routes = [
    {path: '/', component: Login, name: '/'},
    {path: '/register', component: Register, name: 'register'},
    {path: '/logout', component: Logout, name: 'logout'},
    {path: '/home', component: Home, name: 'home'},
    {path: '/create-employee', component: CreateEmployee, name: 'create-employee'},
    {path: '/index-employee', component: IndexEmployee, name: 'index-employee'},
    {path: '/edit-employee', component: EditEmployee, name: 'edit-employee'},
]
