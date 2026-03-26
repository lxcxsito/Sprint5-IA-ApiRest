import { useState } from "react";
import { updateUser } from "../services/user";
import "./EditProfile.css";

export default function EditProfile({ user, setUser }) {

  const [name, setName] = useState(user?.name || "");
  const [email, setEmail] = useState(user?.email || "");
  const [password, setPassword] = useState("");

  const handleSubmit = async (e) => {
    e.preventDefault();

    try {
      const updatedUser = await updateUser(user.id, {
        name,
        email,
        ...(password && { password })
      });

      setUser(updatedUser); // 🔥 actualiza navbar
      alert("Perfil actualizado");

    } catch (error) {
      alert(error.response?.data?.message || "Error actualizando perfil");
    }
  };

  return (
    <div className="edit-profile-container">

      <form className="edit-profile-form" onSubmit={handleSubmit}>

        <h1>Editar perfil</h1>

        <input
          type="text"
          placeholder="Nombre"
          value={name}
          onChange={(e) => setName(e.target.value)}
        />

        <input
          type="email"
          placeholder="Email"
          value={email}
          onChange={(e) => setEmail(e.target.value)}
        />

        <input
          type="password"
          placeholder="Nueva contraseña (opcional)"
          value={password}
          onChange={(e) => setPassword(e.target.value)}
        />

        <button type="submit">
          Guardar cambios
        </button>

      </form>

    </div>
  );
}