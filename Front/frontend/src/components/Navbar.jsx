import { Link } from "react-router-dom";
import LogoutButton from "./LogoutButton";
import "./Navbar.css";

export default function Navbar({ user, setUser }) {

  return (
    <nav className="navbar">

      <h2 className="logo">GameStore</h2>

      <div className="nav-links">

        <Link to="/">Home</Link>

        <Link to="/games">Tienda</Link>

        <Link to="/stats/top-rated">Top Rated</Link>

        <Link to="/stats/most-sold">Most Sold</Link>

        <Link to="/stats/top-buyers">Top Buyers</Link>

        {user && (
          <>
            <Link to="/my-games">Mi biblioteca</Link>
            <Link to="/edit-profile">Edit profile</Link>
            {user.role === "admin" && (
              <Link to="/admin/games">Admin</Link>
            )}
            <LogoutButton setUser={setUser} />

          </>
        )}

        {!user && (
          <>
            <Link to="/register">Register</Link>
            <Link to="/login">Login</Link>
          </>
        )}

      </div>

    </nav>
  );
}