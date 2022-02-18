import { useDispatch, useSelector } from 'react-redux';
import { useEffect, useLayoutEffect, useRef } from 'react';
// Action to open the menu and login
import { openMenu, openLogin, fadeSwitch } from 'src/actions/okdo';
import { logIn } from 'src/actions/user';

import './style.scss';
import { Link } from 'react-router-dom';

// Icons import
import AccountCircleIcon from '@mui/icons-material/AccountCircle';
import MenuIcon from '@mui/icons-material/Menu';

// This component contains the header of our website with icons for burger menu and login button

const AppHeader = () => {
  const dispatch = useDispatch();

  const fade = useSelector((state) => state.fadeProp);
  const isLogged = useSelector((state) => state.isLogged);
  const name = useSelector((state) => state.firstname);

  // console.log(fade);

  let helloClass = 'hello';

  // console.log(helloClass);

  if (fade === true) {
    helloClass = 'hello fade-in';
  }

  if (fade === false) {
    helloClass = 'hello fade-out';
  }

  // console.log(helloClass);

  const isFirstRun = useRef(true);

  useEffect(() => {
    if (isFirstRun.current) {
      isFirstRun.current = false;
      setTimeout(() => {
        if (isLogged === true) {
          dispatch((fadeSwitch()));
        };
      }, 2000);
      console.log("ok");
      return;
    }
  }, [isLogged === true]);

  return (
    <header className="header">
      <button type="button" className="button button-nav">
        <MenuIcon
          fontSize="large"
          onClick={() => {
            dispatch(openMenu());
          }}
        />
      </button>
      <Link
        className="logo-link"
        to="/"
      >
        <div className="logo">
          <img
            src="https://cdn.pixabay.com/photo/2017/10/20/20/37/gift-boxes-2872745_960_720.png"
            alt="yellow gift logo"
          />

        </div>
        <h1 className="logo-title">O'KDO</h1>
      </Link>
      <div className="login">
        <button className="button login-button" type="button">
          <AccountCircleIcon
            fontSize="large"
            onClick={() => {
              dispatch(openLogin());
            }}
          />
        </button>
      </div>
      {isLogged
      && (
        <div className={helloClass}>
          <p>{`Bonjour ${name}`}</p>
        </div>
      )}
    </header>
  );
};

export default AppHeader;
