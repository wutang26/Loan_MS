import { createBrowserRouter } from "react-router-dom";
import Home from "../views/Home";
import Login from "../views/Login";
import NotFound from "../views/NotFound";
import Signup from "../views/Signup";
import DefaultLayout from "./components/DefaultLayout";
import GuestLayout from "./components/GuestLayout";
import Users from "../views/Users";
import Dashboard from "../views/Dashboard";
// import Dashboard from "@/Pages/Dashboard";

//ROUTES OF PAGES
const router = createBrowserRouter([
  
  {
    path: "/",
    element: <DefaultLayout />,

    children: [
       {
    path: "/users",
    element: <Users />,
       },
       {
    path: "/Dashboard",
    element: <Dashboard />
       },
    ]
  },
    {
    path: "/GuestLayout",
    element: <GuestLayout />
  },
  {
    path: "/Home",
    element: <Home />,
  },
   {
    path: "/Signup",
    element: <Signup />,
  },
   {
    path: "/Login",
    element: <Login />,
  },
    {
    path: "*",
    element: <NotFound />,
  },
]);

export default router;
