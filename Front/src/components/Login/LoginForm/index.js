import { useSelector, useDispatch } from 'react-redux';
// Action to open the menu and login
import { closeLogin } from 'src/actions/okdo';
import { inputChange, logIn } from 'src/actions/user';

// import CloseIcon from '@mui/icons-material/Close';
// import { deepOrange } from '@mui/material/colors';
import { Link } from 'react-router-dom';

import './style.scss';

// This component contains login form imputs elements
const LoginForm = ({ mail, password }) => {
  const mailLogin = useSelector((state) => state.mailLogin);
  const passwordLogin = useSelector((state) => state.passwordLogin);

  const dispatch = useDispatch();
  return (
    <form action="" method="get" className="loginForm">
      <div className="singleLoginForm">
        <label htmlFor="email">
          <input
            type="text"
            name="name"
            id="name"
            placeholder="Adresse
            email"
            className="input"
            value={mailLogin}
            onChange={(event) => {
              dispatch(inputChange(event.currentTarget.value, mail));
            }}
            required
          />
        </label>
      </div>
      <div className="singleLoginForm">
        <label htmlFor="password">
          <input
            type="password"
            name="password"
            id="password"
            placeholder="Mot de passe"
            className="input"
            value={passwordLogin}
            onChange={(event) => {
              dispatch(inputChange(event.currentTarget.value, password));
            }}
            required
          />
        </label>
      </div>
      <div className="submitDiv">
        <input
          type="submit"
          value="Connexion"
          className="connexionButton"
          onClick={(event) => {
            event.preventDefault();
            dispatch(logIn());
          }}
        />
      </div>
      <Link
        to="/creer-mon-compte"
        className="accountCreation-login"
        onClick={() => {
          dispatch(closeLogin());
        }}
      >
        Créer un compte
      </Link>
    </form>
  );
};

export default LoginForm;
