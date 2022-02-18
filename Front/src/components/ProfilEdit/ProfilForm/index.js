/* eslint-disable max-len */
import './style.scss';

import { useState, useEffect } from 'react';
import { MultiSelect } from 'react-multi-select-component';
import { useSelector, useDispatch } from 'react-redux';
import { Link } from 'react-router-dom';

import { pushName } from 'src/actions/okdo';
import { inputChange, pushEditProfil, updateProfile } from 'src/actions/user';

const profilForm = ({
  ages,
  categories,
  event,
  genre,
  name,
  id,
}) => {
  const dispatch = useDispatch();

  const inputValue = useSelector((state) => state.editNameProfileInput);

  const allAges = useSelector((state) => state.ages);
  const allCategories = useSelector((state) => state.categories);
  const allEvents = useSelector((state) => state.events);
  const allGenres = useSelector((state) => state.gender);

  useEffect(() => {
    dispatch(pushName(name));
  }, []);

  // Map on the ages, to get the data format needed by the comp
  const agesData = ages.map((age) => ({ label: age.label, value: age.label, id: age.id}));

  const categoriesData = categories.map((category) => ({ label: category.label, value: category.label, id: category.id }));

  // will be replace with redux state
  const [categorySelected, setCategorySelected] = useState(categoriesData);
  const [ageSelected, setAgeSelected] = useState(agesData);
  const [sexSelected, setSexSelected] = useState([{ label: genre.label, value: genre.label, id: genre.id }]);
  const [eventSelected, setEventSelected] = useState([{ label: event.label, value: event.label, id: event.id }]);

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

  return (
    <div className="form">
      <h1 className="profilEdit-title">Modifier le profil enregistré</h1>
      <form className="profilEditForm">
        <label>
          <input
            type="text"
            name="name"
            className="input"
            value={inputValue}
            onChange={(evt) => {
              dispatch(inputChange(evt.currentTarget.value, 'editNameProfileInput'));
            }}
          />
        </label>
        <p>Modifier la catégorie </p>
        <MultiSelect
          className="multiSelect"
          options={allCategories}
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
            selectSomeItems: 'Catégorie',
            create: 'Créer',
          }}
        />
        <p>Modifier la tranche d'âge</p>
        <MultiSelect
          className="multiSelect"
          options={allAges}
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
            selectSomeItems: 'Tranche d\'âge',
            create: 'Créer',
          }}
        />
        <p>Modifier le genre</p>
        <MultiSelect
          className="multiSelect"
          options={allGenres}
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
            selectSomeItems: 'Genre',
            create: 'Créer',
          }}
        />
        <p>Modifier l'évènement associé</p>
        <MultiSelect
          className="multiSelect"
          options={allEvents}
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
            selectSomeItems: 'Évènement',
            create: 'Créer',
          }}
        />
        <Link
          to="/mes-profils"
        >
          <input
            type="submit"
            value="Valider"
            className="profilSubmit"
            onClick={() => {
              dispatch(pushEditProfil(categorySelected, ageSelected, sexSelected, eventSelected, id));
              dispatch(updateProfile());
            }}
          />
        </Link>
      </form>
    </div>
  );
};

export default profilForm;
