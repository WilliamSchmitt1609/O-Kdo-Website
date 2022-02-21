import { useSelector, useDispatch } from 'react-redux';
import { useRef } from 'react';
import { Link } from 'react-router-dom';
// Action to open the menu and login
import { closeLogin } from 'src/actions/okdo';

import { logOut } from 'src/actions/user';

import CloseIcon from '@mui/icons-material/Close';
// import { deepOrange } from '@mui/material/colors';

import LoginForm from 'src/components/Login/LoginForm';

import { closeLoginClick } from 'src/selectors/functions';

import './style.scss';

// This component contains the user login form.
// The user can be logged to his account with email and password.
// The login will appear as a pop-up from the right by clicking on the profile icon of the header

const Login = ({ mail, password }) => {
  const dispatch = useDispatch();
  const loginMenu = useSelector((state) => state.loginIsClicked);

  const isLogged = useSelector((state) => state.isLogged);
  const role = useSelector((state) => state.role);

  // We define the wrapper
  const wrapperRef = useRef(null);
  // We call the function to close the menu at click outside of it
  closeLoginClick(wrapperRef);

  // We set the className of the menu to "menu"
  let loginClass = 'loginPopUp';
  // If click on the burger, class become 'menu menu--open'
  if (loginMenu === true) {
    loginClass = 'loginPopUp loginPopUp--open';
  }
  // If click on cross class become 'menu menu--close' to still exist and go outside of the screen
  if (loginMenu === 'close') {
    loginClass = 'loginPopUp loginPopUp--close';
  }

  let logged = '';

  if (isLogged === true) {
    logged = 'logged';
  }

  return (
  // According to the value of isClicked, the class CSS name will be
  // menu--open (if true) or menu--close(if false)

    <div className={`${loginClass} ${logged}`} ref={wrapperRef}>
      <div className="loginContainer">
        <div className="icon" />
        <div className="wrapContainer">
          {!isLogged && <LoginForm mail={mail} password={password} />}
          {isLogged
            && (
            <button
              type="button"
              className="connexionButton deco"
              onClick={() => {
                // We dispatch the logOut function to clear the state
                dispatch(logOut());
                // And we clear the local storage
                localStorage.clear();
              }}
            >Déconnexion
            </button>
            )}
          {isLogged && (role[0] === 'ROLE_ADMIN' || role[0] === 'ROLE_MANAGER')
            && (
              <a href="http://back.o-kdo.org" className="backoffice-access">Accéder au backoffice</a>
            )}
        </div>

        <div className="icon">
          <CloseIcon
            className="closeButton"
            // sx={{ color: deepOrange[50] }}
            fontSize="large"
            onClick={() => {
              dispatch(closeLogin());
            }}
          />
        </div>
      </div>
    </div>
  );
};

export default Login;
