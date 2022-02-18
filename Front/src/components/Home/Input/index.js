import { useState, useEffect } from 'react';
import { MultiSelect } from 'react-multi-select-component';
import { Link } from 'react-router-dom';
import { useSelector, useDispatch } from 'react-redux';

import { saveSearch,
  emptySearch,
  searchToApi,
  closeMenu,
  displayRequiredInfos,
  hideRequiredInfos,
} from 'src/actions/okdo';

import './style.scss';

// To replace with redux
const Input = () => {
  const [categorySelected, setCategorySelected] = useState([]);
  const [ageSelected, setAgeSelected] = useState([]);
  const [sexSelected, setSexSelected] = useState([]);
  const [eventSelected, setEventSelected] = useState([]);

  const categories = useSelector((state) => state.categories);
  const ages = useSelector((state) => state.ages);
  const genders = useSelector((state) => state.gender);
  const events = useSelector((state) => state.events);
  const display = useSelector((state) => state.display);

  const dispatch = useDispatch();

  // Single option clickable
  useEffect(() => {
    if (sexSelected.length > 1) {
      setSexSelected([sexSelected[sexSelected.length - 1]]);
    }
  }, [sexSelected]);

  useEffect(() => {
    if (eventSelected.length > 1) {
      setEventSelected([eventSelected[eventSelected.length - 1]]);
    }
  }, [eventSelected]);

  // function to check if all selects have at least one option chosen
  // eslint-disable-next-line consistent-return
  const isEmpty = () => {
    if (categorySelected.length === 0 || ageSelected.length === 0
      || sexSelected.length === 0 || eventSelected.length === 0) {
      return true;
    }
  };

  // condition for setup the display or hidding class for the required selects infos
  let displayClass = '';
  // eslint-disable-next-line no-unused-expressions
  (display === false ? displayClass = '' : displayClass = 'display');

  return (
    <div className="homeForm">
      <div className="welcome-content">
        <h2 className="welcome-title">Avec O'Kdo, trouver le bon cadeau n'est plus un fardeau ! </h2>
      </div>
      <MultiSelect
        className="select"
        options={categories}
        value={categorySelected}
        onChange={setCategorySelected}
        labelledBy="Select"
        overrideStrings={{
          allItemsAreSelected: 'Toutes les catégories sont sélectionnées',
          clearSearch: 'Clear Search',
          clearSelected: 'Clear Selected',
          noOptions: 'Aucun résultats',
          search: 'Rechercher',
          selectAll: 'Tout sélectionner',
          selectAllFiltered: 'Select All (Filtered)',
          selectSomeItems: 'Quel style de cadeau? ',
          create: 'Créer',
        }}
      />
      <MultiSelect
        className="select"
        options={ages}
        value={ageSelected}
        onChange={setAgeSelected}
        labelledBy="Select"
        overrideStrings={{
          allItemsAreSelected: 'Toutes les tranches d\'âge sont sélectionnées',
          clearSearch: 'Clear Search',
          clearSelected: 'Clear Selected',
          noOptions: 'Aucun résultats',
          search: 'Rechercher',
          selectAll: 'Tout sélectionner',
          selectAllFiltered: 'Select All (Filtered)',
          selectSomeItems: 'Quelle catégorie d\'âge?',
          create: 'Créer',
        }}
      />
      <MultiSelect
        className="select"
        options={genders}
        value={sexSelected}
        onChange={setSexSelected}
        labelledBy="Select"
        hasSelectAll={false}
        overrideStrings={{
          allItemsAreSelected: '',
          clearSearch: 'Clear Search',
          clearSelected: 'Clear Selected',
          noOptions: 'Aucun résultats',
          search: 'Rechercher',
          selectAll: 'Tout sélectionner',
          selectAllFiltered: 'Select All (Filtered)',
          selectSomeItems: 'A qui est-il destiné?',
          create: 'Créer',
        }}
      />
      <MultiSelect
        className="select"
        options={events}
        value={eventSelected}
        onChange={setEventSelected}
        labelledBy="Select"
        hasSelectAll={false}
        overrideStrings={{
          allItemsAreSelected: 'Tous les types d\'évennements sont sélectionnés',
          clearSearch: 'Clear Search',
          clearSelected: 'Clear Selected',
          noOptions: 'Aucun résultats',
          search: 'Rechercher',
          selectAll: 'Tout sélectionner',
          selectAllFiltered: 'Select All (Filtered)',
          selectSomeItems: 'A quelle occasion?',
          create: 'Créer',
        }}
      />
      <Link
        to="/produits"
      >
        <button
          type="submit"
          className="submitButton"
          onClick={(e) => {
            if (!isEmpty()) {
              dispatch(hideRequiredInfos());
              // we empty the search
              dispatch(emptySearch());
              // we save values in the state
              dispatch(saveSearch(categorySelected, ageSelected, sexSelected, eventSelected));
              // and we call API to get products
              dispatch(searchToApi());
            }
            else {
              dispatch(displayRequiredInfos());
              e.preventDefault();
            }
          }}
        >Rechercher
        </button>
      </Link>
      <p className={`requiredInfos ${displayClass}`}>
        Veuillez renseignez tout les champs
      </p>
    </div>
  );
};

export default Input;
