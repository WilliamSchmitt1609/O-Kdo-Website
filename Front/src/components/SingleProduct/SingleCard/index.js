import './style.scss';

import PropTypes from 'prop-types';

// This card contains product's features and will appear
// on the results page following the searching criteria entered

const SingleCard = ({
  name,
  price,
  picture,
  description,
  categories,
}) => (
  <div className="content--product">
    <div className="img">
      <img
        className="fit-picture fit-picture--single"
        src={picture}
        alt="Grapefruit slice atop a pile of other slices"
      />
    </div>
    <div className="info">
      <h2 className="productName">{name}</h2>
      <p className="productInfo">{description}</p>
      <p className="productInfo productInfo--price">{price}€</p>
      <button type="button" className="submitButton submitButton--buy">Acheter</button>
      {categories.map((item) => (
        <p className="productInfo productInfo--tags" key={item.label}>#{item.label}</p>
      ))}
    </div>
  </div>
);

export default SingleCard;

SingleCard.propTypes = {
  name: PropTypes.string.isRequired,
  price: PropTypes.number.isRequired,
  categories: PropTypes.arrayOf(PropTypes.object).isRequired,
  picture: PropTypes.string.isRequired,
  description: PropTypes.string.isRequired,
};
