import './style.scss';
import PropTypes from 'prop-types';

// This card contains product's features and will appear
// on the results page following the searching criteria entered

const Card = ({
  name,
  price,
  categories,
  picture,
}) => (

  <div className="card">
    <div>
      <div className="img">
        <img
          className="fit-picture"
          src={picture}
          alt="product"
        />
      </div>
      <div className="info">
        <h2 className="productName">{name}</h2>
        <p className="productInfo price">{price}€</p>
      </div>
    </div>
    <div className="tags">
      {categories.map((item) => (
        <p className="productInfo" key={item.label}>
          #{item.label}
        </p>
      ))}
    </div>
  </div>
);

export default Card;

Card.propTypes = {
  name: PropTypes.string.isRequired,
  price: PropTypes.number.isRequired,
  categories: PropTypes.arrayOf(PropTypes.object).isRequired,
  picture: PropTypes.string.isRequired,
};
