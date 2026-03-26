<h2>Reviews</h2>

{reviews.map((review) => (
  <div key={review.id}>
    <p><strong>{review.user.name}</strong></p>
    <p>⭐ {review.rating}</p>
    <p>{review.comment}</p>
  </div>
))}