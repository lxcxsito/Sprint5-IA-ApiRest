import { purchaseGame } from "../services/purchases";

export default function PurchaseButton({ gameId }) {
  const handlePurchase = async () => {
    try {
      const response = await purchaseGame(gameId);
      alert(response.message || "Juego comprado correctamente");
    } catch (error) {
      console.error("Error comprando juego", error);
      alert("Error al comprar el juego");
    }
  };

  return (
    <button onClick={handlePurchase}>
      Comprar juego
    </button>
  );
}