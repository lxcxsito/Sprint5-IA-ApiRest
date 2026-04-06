import { useState } from "react";
import "./GameForm.css";

export default function GameForm({ onSubmit, initialData = {} }) {

  const [title, setTitle] = useState(initialData.title || "");
  const [description, setDescription] = useState(initialData.description || "");
  const [price, setPrice] = useState(initialData.price || "");
  const [urlImage, setUrlImage] = useState(initialData.urlImage || "");
  const [categoryId, setCategoryId] = useState("");

  const handleSubmit = (e) => {
    e.preventDefault();

    onSubmit({
      title,
      description,
      price,
      urlImage,
      category_id: categoryId
    });
  };

  return (
    <form onSubmit={handleSubmit}>

      <input
        type="text"
        placeholder="Título"
        value={title}
        onChange={(e) => setTitle(e.target.value)}
      />

      <input
        type="text"
        placeholder="Descripción"
        value={description}
        onChange={(e) => setDescription(e.target.value)}
      />

      <input
        type="number"
        placeholder="Precio"
        value={price}
        onChange={(e) => setPrice(e.target.value)}
      />

      <input
        type="text"
        placeholder="URL imagen"
        value={urlImage}
        onChange={(e) => setUrlImage(e.target.value)}
      />

      <input
        type="number"
        placeholder="Category ID"
        value={categoryId}
        onChange={(e) => setCategoryId(e.target.value)}
      />

      <button type="submit">
        Crear juego
      </button>

    </form>
  );
}