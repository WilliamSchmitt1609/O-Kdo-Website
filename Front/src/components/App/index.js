import { useSelector, useDispatch } from 'react-redux';
import { useEffect } from 'react';
import { Routes, Route, Navigate } from 'react-router-dom';

import {
  fetchEvents,
  fetchGender,
  fetchCategories,
  fetchAges,
  loaderOff,
  closeLogin,
  closeMenu,
  fadeSwitch,
} from 'src/actions/okdo';
import { importUserToken, getInfos } from 'src/actions/user';
// == Import
import './styles.scss';

// == Composant import
import Home from 'src/components/Home';
import ProductsList from 'src/components/ProductsList';
import Profiles from 'src/components/Profiles';
import ProfilEdit from 'src/components/ProfilEdit';
import SingleProduct from 'src/components/SingleProduct';
import AccountCreation from 'src/components/AccountCreation';
import Menu from 'src/components/Menu';
import Login from 'src/components/Login';
import Loader from 'src/components/App/Loader';
import Error from 'src/components/Error';
import ContactPage from 'src/components/ContactPage';

// == Composant
const App = () => {
  const dispatch = useDispatch();

  const loading = useSelector((state) => state.loading);
  const isLogged = useSelector((state) => state.isLogged);

  // useEffect(() => {
  //   dispatch(closeMenu());
  //   dispatch(closeLogin());
  // }, [App]);

  useEffect(() => {
    // eslint-disable-next-line max-len
    // if a token exist, we push it into the state, then we call getInfos action to get all the informations
    if (localStorage.newToken) {
      const localToken = localStorage.getItem('newToken');
      dispatch(fadeSwitch());
      dispatch(importUserToken(localToken));
      dispatch(getInfos());
    }
    else {
      dispatch(loaderOff());
    }
    // We get all select options from the API
    dispatch(fetchCategories());
    dispatch(fetchEvents());
    dispatch(fetchAges());
    dispatch(fetchGender());
  }, []);
  // We need to import the Menu with animation here, set it to false at start,
  // for it to not appear. Then on click on the burger menu, we set it at true
  // The component can appear now. When we click on the cross, we set it on "close" : the component
  // still exist, but it go out of the screen and we can display the animation

  const isClicked = useSelector((state) => state.burgerIsClicked);
  // Same for the login menu
  const loginMenu = useSelector((state) => state.loginIsClicked);
  // At start or refresh, we only display the loader. When whe get all the infos
  if (loading) {
    return <Loader />;
  }

  return (
    <div className="app">
      {isClicked && <Menu />}
      {loginMenu && <Login mail="mailLogin" password="passwordLogin" />}
      {/* We set up the Router of our website using react-router-dom */ }
      <Routes>
        <Route
          path="/"
          element={<Home />}
          key="home"
        />
        <Route
          path="/creer-mon-compte"
          element={<AccountCreation firstName="firstNameSignIn" lastName="lastNameSignIn" email="mailSignIn" password="passwordSignIn" />}
          key="accountCreation"
        />
        <Route
          path="/produits"
          element={<ProductsList registeredProfil="registeredProfil" />}
          key="productsList"
        />
        <Route
          path="/mes-profils"
          element={isLogged ? <Profiles /> : <Navigate to="/" replace />}
          key="profiles"
        />
        <Route
          path="/produit/:slug"
          element={<SingleProduct />}
          key="product"
        />
        <Route
          path="/modifier-profil/:slug"
          element={isLogged ? <ProfilEdit /> : <Navigate to="/" replace />}
          key="profilEdit"
        />
        <Route
          path="*"
          element={<Error />}
          key="error"
        />
        <Route
          path="/contact"
          element={<ContactPage />}
          key="contactPage"
        />
      </Routes>
    </div>
  );
};

// == Export
export default App;
