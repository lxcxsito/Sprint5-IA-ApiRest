import { createReview } from "../services/reviews";

const [rating, setRating] = useState("");
const [comment, setComment] = useState("");

const handleReview = async (e) => {
  e.preventDefault();

  try {
    await createReview(id, { rating, comment });
    alert("Review creada");

    const data = await getReviews(id);
    setReviews(data);

  } catch (error) {
    alert(error.response?.data?.message);
  }
};