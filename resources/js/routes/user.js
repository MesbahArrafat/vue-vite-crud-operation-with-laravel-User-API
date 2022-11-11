import { createRouter,createWebHistory } from "vue-router";
import UserTable from '../components/UserTable.vue';
import UserEditForm from '../components/UserEditForm.vue';
import UserCreateForm from '../components/UserCreateForm.vue';
import StudentTable from '../components/StudentTable.vue';
import StudentEditForm from '../components/StudentEditForm.vue';
import StudentCreateForm from '../components/StudentCreateForm.vue';
const routes = [
    {
        path:'/',
        name:'user-table',
        component:UserTable
    },
    {
        path:'/edit/:id',
        name:'edit',
        component:UserEditForm
    },
    {
        path:'/create',
        name:'create',
        component:UserCreateForm
    },
    {
        path:'/student',
        name:'student-table',
        component:StudentTable
    },
    {
        path:'/student/edit/:id',
        name:'student-edit',
        component:StudentEditForm
    },
    {
        path:'/student/create',
        name:'student-create',
        component:StudentCreateForm
    }
];
const router = createRouter({
    history:createWebHistory(import.meta.env.BASE_URL),
    routes
});
export default router;