import { useEffect, useState } from "react";
import { useParams } from "react-router-dom";
import { getGameById } from "../services/games";
import { getReviews, createReview } from "../services/reviews";
import PurchaseButton from "../components/PurchaseButton";
import "./GameDetail.css";
import "./Reviews.css";
import "./ReviewForm.css";

export default function GameDetail() {
  const { id } = useParams();

  const [game, setGame] = useState(null);
  const [reviews, setReviews] = useState([]);

  const [rating, setRating] = useState("");
  const [comment, setComment] = useState("");

  useEffect(() => {
    const fetchGame = async () => {
      try {
        const data = await getGameById(id);
        setGame(data);
      } catch (error) {
        console.error("Error cargando juego", error);
      }
    };

    fetchGame();
  }, [id]);

  useEffect(() => {
    const fetchReviews = async () => {
      try {
        const data = await getReviews(id);
        setReviews(data);
      } catch (error) {
        console.error("Error cargando reviews", error);
      }
    };

    fetchReviews();
  }, [id]);

  // 🔹 crear review
  const handleReview = async (e) => {
    e.preventDefault();

    try {
      await createReview(id, { rating, comment });

      alert("Review creada");

      const data = await getReviews(id);
      setReviews(data);

      setRating("");
      setComment("");

    } catch (error) {
      alert(error.response?.data?.message);
    }
  };

  if (!game) return <p>Cargando...</p>;

  return (
    <div className="game-detail-container">

      <h1>{game.title}</h1>

      <img
        src={`/${game.urlImage}`}
        alt={game.title}
        onError={(e) => {
          e.target.src = "/images/games/notfound.jpg";
        }}
      />


      <p>{game.description}</p>

      <p className="price">Precio: {game.price} €</p>

      <div className="purchase-button">
        <PurchaseButton gameId={game.id} />
      </div>

      <p>Categoría: {game.category?.name}</p>

      {localStorage.getItem("token") && (
        <>
          <h2>Dejar una review</h2>

          <form onSubmit={handleReview}>
            <input
              type="number"
              placeholder="Rating (1-5)"
              value={rating}
              onChange={(e) => setRating(e.target.value)}
            />

            <input
              type="text"
              placeholder="Comentario"
              value={comment}
              onChange={(e) => setComment(e.target.value)}
            />

            <button type="submit">Send review</button>
          </form>
        </>
      )}

      <h2>Reviews</h2>

      {reviews.length === 0 && <p>No hay reviews todavía</p>}

  {reviews.map((review) => (
    <div key={review.id} className="review-card">
      <strong>{review.user?.name}</strong>
      <p className="rating">⭐ {review.rating}</p>
      <p>{review.comment}</p>
    </div>
  ))}


    </div>
  );
}