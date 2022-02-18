import { useSelector, useDispatch } from 'react-redux';
import { Link } from 'react-router-dom';
import { useRef } from 'react';

// Action to open and close the menu
import {
  closeMenu,
  emptySearch,
  saveSearch,
  searchToApi,
} from 'src/actions/okdo';

import CloseIcon from '@mui/icons-material/Close';
import ProfileLink from 'src/components/Menu/ProfileLink';

import './style.scss';

import { closeMenuClick } from 'src/selectors/functions';

const Menu = () => {
  const isClicked = useSelector((state) => state.burgerIsClicked);
  const profileList = useSelector((state) => state.profiles);
  const isLogged = useSelector((state) => state.isLogged);

  const dispatch = useDispatch();

  // We define the wrapper
  const wrapperRef = useRef(null);
  // We call the function to close the menu at click outside of it
  closeMenuClick(wrapperRef);

  // We set the className of the menu to "menu"
  let menuClass = 'menu';
  // If click on the burger, class become 'menu menu--open'
  if (isClicked === true) {
    menuClass = 'menu menu--open';
  }
  // If click on cross class become 'menu menu--close' to still exist and go outside of the screen
  if (isClicked === 'close') {
    menuClass = 'menu menu--close';
  }

  // According to the value of isClicked, the class CSS name will be
  // menu--open (if true) or menu--close(if false)
  // ref wrapperRef is use to close the menu when we click outside of the div
  return (
    <div className={menuClass} ref={wrapperRef}>
      <div className="headerTitle">
        <div className="icon">
          <CloseIcon
            className="closeButton"
            fontSize="large"
            onClick={() => {
              dispatch(closeMenu());
            }}
          />
        </div>
        <h1>Menu</h1>
        <div className="icon" />
      </div>
      {isLogged
      && (
        <Link
          to="/mes-profils"
          className="allProfiles"
          onClick={() => {
            dispatch(closeMenu());
          }}
        >
          Tous mes profils
        </Link>
      )}
      <div>
        {profileList.map((profil) => (
          <Link
            to="/produits"
            className="profileMenu-title"
            onClick={() => {
              dispatch(emptySearch());
              dispatch(saveSearch(profil.categories, profil.ages, [profil.genre], [profil.event]));
              dispatch(searchToApi());
            }}
            key={profil.id}
          >
            <ProfileLink name={profil.name} />
          </Link>
        ))}
      </div>
      <Link
        className="linkContact"
        to="/contact"
        onClick={() => {
          dispatch(closeMenu());
        }}
      >
        La Team
      </Link>
    </div>
  );
};

export default Menu;
