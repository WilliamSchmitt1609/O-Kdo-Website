import { useDispatch, useSelector } from 'react-redux';
import { Link } from 'react-router-dom';
import PropTypes from 'prop-types';
import { useEffect } from 'react';

import { stateDeleteProfile, deleteProfile, getInfos } from 'src/actions/user';
import {
  searchToApi,
  saveSearch,
  emptySearch,
  showPopUpDel,
  hidePopUpDel,
} from 'src/actions/okdo';

import DeleteForeverIcon from '@mui/icons-material/DeleteForever';
import EditIcon from '@mui/icons-material/Edit';

import './style.scss';

const Profil = ({
  name,
  categories,
  genre,
  event,
  ages,
  id,
  slug,
}) => {
  const dispatch = useDispatch();
  const popUpDel = useSelector((state) => state.showPopUpDel);

  useEffect(() => {
    setTimeout(() => {
      dispatch((hidePopUpDel()));
    }, 2050);
  }, [popUpDel]);

  return (
    <div className="profilCard">
      <div className="cardProfilInfo">
        <img
          className="profil-picture"
          src="https://cdn.discordapp.com/attachments/934036971783864360/935918143216451584/2289_SkVNQSBGQU1PIDEwMjgtMTIz.jpg"
          alt="profil avatar"
        />
        <h2 className="profilName">{name}</h2>
        {categories.map((category) => (
          <p key={category.label} className="profilInfo cat">{category.label}</p>
        ))}
        {ages.map((age) => (
          <p key={age.label} className="profilInfo age">{age.label}</p>
        ))}
        <p key={genre.label} className="profilInfo genre">{genre.label}</p>
        <p key={event.label} className="profilInfo label">{event.label}</p>
      </div>
      <div className="profilOptions">
        <Link
          to="/produits"
          className="profileMenu-title"
          onClick={() => {
            dispatch(emptySearch());
            dispatch(saveSearch(categories, ages, [genre], [event]));
            dispatch(searchToApi());
          }}
        >
          <button
            className="profilSearchButton"
            type="button"
          >Voir les résultats
          </button>
        </Link>
        <div className="profilIcons">
          <DeleteForeverIcon
            fontSize="large"
            onClick={() => {
              dispatch(showPopUpDel());
              dispatch(stateDeleteProfile(id));
              dispatch(deleteProfile());
              dispatch(getInfos());
            }}
          />
          <Link
            to={`/modifier-profil/${slug}`}
            name={name}
            categories={categories}
            genre={genre}
            event={event}
            ages={ages}
            id={id}
          >
            <EditIcon
              fontSize="large"
            />
          </Link>
        </div>
      </div>
    </div>
  );
};

export default Profil;

Profil.propTypes = {
  name: PropTypes.string.isRequired,
  categories: PropTypes.arrayOf(PropTypes.object).isRequired,
  genre: PropTypes.object.isRequired,
  event: PropTypes.object.isRequired,
  ages: PropTypes.arrayOf(PropTypes.object).isRequired,
  id: PropTypes.number.isRequired,
  slug: PropTypes.number.isRequired,
};
