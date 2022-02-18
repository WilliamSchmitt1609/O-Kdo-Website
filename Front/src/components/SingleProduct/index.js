import { useParams, useNavigate } from 'react-router-dom';
import { useSelector } from 'react-redux';

import { FaReply } from 'react-icons/fa';

import AppHeader from 'src/components/AppHeader';
import Footer from 'src/components/Footer';
import SingleCard from 'src/components/SingleProduct/SingleCard';

import './style.scss';

const SingleProduct = () => {
  const productsList = useSelector((state) => state.productResearch);
  // We use the react-router-dom hooks to go back on Click
  const navigate = useNavigate();

  const parameters = useParams();
  const currentSlug = parameters.slug;
  // We compare the id of the product to the slug, to diplay the correct informations about it
  const product = productsList.filter((item) => item.id == currentSlug);

  return (

    // isCliked is set on false at start. The component will appear (set to !false)
    // on click on the burger menu
    // invisible div added to center the form
    <div className="content singleProductContent">
      <AppHeader />
      <div className="invisible-div" />
      <main className="main main--product">
        <button
          type="button"
          className="submitButton submitButton--single mobile"
          onClick={() => navigate(-1)}
        >
          <FaReply className="reply" />Revenir aux résultats
        </button>
        {product.map((item) => (
          <SingleCard {...item} key={item.name} />
        ))}
      </main>
      <Footer />
    </div>
  );
};

export default SingleProduct;
