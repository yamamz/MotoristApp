import Login from "../components/login/Login";
import Layout from "../components/layout/Layout";
import Members from "../pages/member/members";
import MembersAdd from "../pages/member/memberAdd";
import chart from "../pages/member/chart";

export default [
    // parametric route for GCCv1 requests

    {
        path: "/",
        name: "index",
        component: Layout,
        meta: { requiresAuth: true }
    },
    {
        path: "/members",
        name: "member",
        component: Layout,
        meta: { requiresAuth: true },
        children: [
            {
                path: "",
                name: "member list",
                component: Members,
                meta: { requiresAuth: true }
            },
            {
                path: "add",
                name: "member add",
                component: MembersAdd,
                meta: { requiresAuth: true }
            },
            {
                path: "chart/:id",
                name: "chart",
                component: chart,
                meta: { requiresAuth: true }
            }
        ]
    },
    {
        path: "/login",
        name: "login",
        component: Login
        // hidden: true,
        // meta: {requiresGuest: true, title: 'Login' }
    }
];
