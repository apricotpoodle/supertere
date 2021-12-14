'Fenêtre frmResultatScrutinLst
Private Function SauvegardeResultatsScrutin() As Boolean
On Error GoTo RESU_ERR
Dim selMessage As String
Dim SumVoix As Long

  SauvegardeResultatsScrutin = True
      ' vérification cohérence inscripts>=votants>=exprimés
      ' 10/09/2001
    If Not VerifVotants(Me) Then
        SauvegardeResultatsScrutin = False
        Screen.MousePointer = vbDefault
        Exit Function
    End If
    If Not VerifExprimes(Me) Then
        SauvegardeResultatsScrutin = False
        Screen.MousePointer = vbDefault
        Exit Function
    End If

  Screen.MousePointer = vbHourglass
  With DataEnvironment1
    SumVoix = SommeResultatCandidature()
    If SumVoix <> NoSeparMil(Me.txtExprime) Then
      If MsgBox("Attention ! La somme des voix obtenues (" & SumVoix & ") doit être égale au total des exprimés. Continuer ?", vbQuestion + vbYesNo) = vbNo Then
        SauvegardeResultatsScrutin = False
        Screen.MousePointer = vbDefault
        Exit Function
      End If
    End If

    If Dirty Then
    ' MAJ si necessaire des valeurs du tableau ( resultat candidature)

      UpdateResultatCandidature
      If Trim(Me.txtSiege) = "" Then
         Me.txtSiege = 0
         End If
      .cmdModEgScru SelElec, selEntgCle, SelIndiCle, SelNumTour, Me.txtSiege, "", Trim(Me.TxtLibel2)

      .cmdModResScru SelElec, selEntgCle, SelIndiCle, SelNumTour, NoSeparMil(Me.txtInscrit), NoSeparMil(Me.txtVotants), NoSeparMil(Me.txtExprime), ""
    End If

    If Me.txtExprime = "0" Or Me.txtInscrit = "0" Or Me.txtVotants = "0" Or SumVoix = 0 Then
      'MsgBox "Calcul de règle impossible. Valeur nulle", vbExclamation
    Else
      .cmdCalculRegle SelElec, Trim(SelTypElec), SelNumTour, selEntgCle, SelIndiCle, Trim(SelTypEnt)
    End If

    ' commit de la transaction en cours
    .Tere2Connection.CommitTrans

    ' ouverture nouvelle transaction
    .Tere2Connection.BeginTrans

    MAJ_TableauResultat
  End With

  Dirty = False
  MsgBox "Validation effectuée.", vbInformation
RESU_EXIT:
  Screen.MousePointer = vbDefault
  Exit Function
RESU_ERR:
  GestionErreur
  Resume RESU_EXIT
End Function
