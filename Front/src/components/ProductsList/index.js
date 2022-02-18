import AppHeader from 'src/components/AppHeader';
import Footer from 'src/components/Footer';
import Card from 'src/components/ProductsList/Card';

import './style.scss';

import { openSaveProfile, closeSaveProfile, openLogin } from 'src/actions/okdo';
import { inputChange, saveProfilApi } from 'src/actions/user';
import { closeSaveClick } from 'src/selectors/functions';

import { useSelector, useDispatch } from 'react-redux';
import { Link } from 'react-router-dom';
import { useRef } from 'react';
import SaveIcon from '@mui/icons-material/Save';
import PropTypes from 'prop-types';

const ProductsList = ({ registeredProfil }) => {
  const saveSearch = useSelector((state) => state.saveIsClicked);
  const newRegisteredProfil = useSelector((state) => state.registeredProfil);
  const productsList = useSelector((state) => state.productResearch);
  const isLogged = useSelector((state) => state.isLogged);

  const dispatch = useDispatch();

  // We define the wrapper
  const wrapperRef = useRef(null);
  // We call the function to close the menu at click outside of it
  closeSaveClick(wrapperRef);

  // isClicked is set on false at start. The component will appear (set to !false)
  // on click on the burger menu
  return (
    <div className="content productListContent">
      <AppHeader />
      <main className="main">
        <div className="invisible-div" />
        <Link
          to="/"
        >
          <button type="button" className="submitButton">Nouvelle recherche</button>
        </Link>
        <button
          type="button"
          className="saveButton"
          onClick={() => {
            dispatch(openSaveProfile());
          }}
        >
          <SaveIcon fontSize="large" />
        </button>
        {/* <div className="productList-title">Résultat de la recherche </div> */}

        {saveSearch && isLogged && (
        <div className="saveInput" ref={wrapperRef}>
          <h2 className="saveInput--title">Enregistrez cette recherche</h2>
          <input
            className="inputSaveSearch"
            type="text"
            name="saveInput"
            placeholder="Nom du profil"
            value={newRegisteredProfil}
            onChange={(event) => {
              dispatch(inputChange(event.currentTarget.value, registeredProfil));
            }}
            required
          />
          <button
            className="submitButton OK"
            type="submit"
            onClick={() => {
              dispatch(saveProfilApi());
            }}
          >OK
          </button>
        </div>
        )}
        {saveSearch && !isLogged && (
        <div className="saveInput" ref={wrapperRef}>
          <h2 className="saveInput--title">Vous devez être connecté pour enregistrer une recherche</h2>
          <Link
            to="/creer-mon-compte"
            onClick={() => {
              dispatch((closeSaveProfile()));
            }}
          >
            <p className="accountLink">Cliquez ici pour créer un compte</p>
          </Link>
          <p
            className="accountLink"
            onClick={() => {
              dispatch(openLogin());
            }}
          >Ou cliquez ici pour vous connecter
          </p>
        </div>
        )}
        <div className="cardsContainer">
          {productsList.map((product) => (
            <Link
              to={`/produit/${product.id}`}
              key={product.name}
            >
              <Card {...product} />
            </Link>
          ))}
        </div>
      </main>
      <Footer />
    </div>
  );
};

export default ProductsList;

ProductsList.propTypes = {
  registeredProfil: PropTypes.string.isRequired,
};
