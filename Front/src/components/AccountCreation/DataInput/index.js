import { useDispatch, useSelector } from 'react-redux';
import { useNavigate } from 'react-router-dom';

import PropTypes from 'prop-types';

// == Import
import { inputChange, createAccount } from 'src/actions/user';

import './styles.scss';

// This component contains the new user account creation form.
const DataInput = ({
  firstName,
  lastName,
  email,
  password,

}) => {
  const dispatch = useDispatch();
  const navigate = useNavigate();

  const firstNameValue = useSelector((state) => state.firstNameSignIn);
  const lastNameValue = useSelector((state) => state.lastNameSignIn);

  const emailValue = useSelector((state) => state.mailSignIn);
  const passwordValue = useSelector((state) => state.passwordSignIn);

  return (
    <div className="account-form">

      <h1 className="page-title">Nouveau ici ? Créez votre compte</h1>
      {/* By clicking on the "Cliquez ici" link, the user will be redirected to the login page */}
      <input
        className="input-style"
        type="firstname"
        id="user_firstname"
        placeholder="Prénom*"
        name="user_firstname"
        value={firstNameValue}
        onChange={(event) => {
          // we use dispatch to send the new value of input action for the firstname
          dispatch(inputChange(event.currentTarget.value, firstName));
        }}
      />
      <input
        className="input-style"
        type="name"
        id="user_name"
        placeholder="Nom*"
        name="user_name"
        value={lastNameValue}
        onChange={(event) => {
          // we use dispatch to send the new value of input action for the lastname
          dispatch(inputChange(event.currentTarget.value, lastName));
        }}
      />

      <input
        className="input-style"
        type="email"
        id="user_email"
        placeholder="Email*"
        name="user_email"
        value={emailValue}
        onChange={(event) => {
          // we use dispatch to send the new value of input action for the email value
          dispatch(inputChange(event.currentTarget.value, email));
        }}
        required

      />
      <input
        className="input-style password"
        type="password"
        id="user_password"
        placeholder="Mot de passe*"
        name="user_password"
        value={passwordValue}
        onChange={(event) => {
          // we use dispatch to send the new value of input action for the password
          dispatch(inputChange(event.currentTarget.value, password));
        }}
        required
      />
      <div className="low-style">Au moins 8 caractères, une majuscule, un chiffre et un caractère spécial  </div>

      <button
        type="button"
        className="submitButton"
        onClick={() => {
          dispatch(createAccount());
          navigate(-1);
        }}
      >
        Valider
      </button>

      <div className="legalTerms">En créant votre compte, vous acceptez nos conditions générales d'utilisation. </div>
    </div>

  );
};

export default DataInput;

DataInput.propTypes = {
  firstName: PropTypes.string.isRequired,
  lastName: PropTypes.string.isRequired,
  email: PropTypes.string.isRequired,
  password: PropTypes.string.isRequired,
};
