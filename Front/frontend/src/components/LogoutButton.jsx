import { logout } from "../services/auth";
import { useNavigate } from "react-router-dom";

export default function LogoutButton({ setUser }) {

  const navigate = useNavigate();

  const handleLogout = async () => {
    await logout();

    setUser(null); // 🔥 navbar se actualiza

    navigate("/login");
  };

  return <button onClick={handleLogout}>Logout</button>;
}