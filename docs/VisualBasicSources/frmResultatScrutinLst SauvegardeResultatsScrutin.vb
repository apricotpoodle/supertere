'Fenêtre frmResultatScrutinLst
Private Function SauvegardeResultatsScrutin() As Boolean
On Error GoTo RESU_ERR
Dim selMessage As String
Dim SumVoix As Long
Dim FlagCand As Boolean
'Positionnement d'un flag indiquant si il y a des candidatures
'Si pas de candidature, cela signifie que l'on met à jour que
'l'étiquette ou le nombre de sièges
'Mis en place pour les municipales 2001
If Me.grdResult.Visible = True Then
   FlagCand = True
   Else
   FlagCand = False
   If Trim(Me.txtSiege) = "" Then
      Me.txtSiege = 0
      End If
   End If

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
    If FlagCand = True Then
       SumVoix = SommeResultatCandidature()
        If SumVoix <> NoSeparMil(Me.txtExprime) Then
           If MsgBox("Attention ! La somme des voix obtenues (" & SumVoix & ") doit être égale au total des exprimés. Continuer ?", vbQuestion + vbYesNo) = vbNo Then
              SauvegardeResultatsScrutin = False
              Screen.MousePointer = vbDefault
              Exit Function
           End If
        End If
    End If

    If Dirty Then
    ' MAJ si necessaire des valeurs du tableau ( resultat candidature)
      If FlagCand = True Then
         UpdateResultatCandidature
         .cmdModResScru SelElec, selEntgCle, SelIndiCle, SelNumTour, NoSeparMil(Me.txtInscrit), NoSeparMil(Me.txtVotants), NoSeparMil(Me.txtExprime), ""

         If Me.txtExprime = "0" Or Me.txtInscrit = "0" Or Me.txtVotants = "0" Or SumVoix = 0 Then
        'MsgBox "Calcul de règle impossible. Valeur nulle", vbExclamation
         Else
         .cmdCalculRegle SelElec, Trim(SelTypElec), SelNumTour, selEntgCle, SelIndiCle, Trim(SelTypEnt)
         End If

      End If

        .cmdModEgScru SelElec, selEntgCle, SelIndiCle, SelNumTour, Me.txtSiege, Trim(Me.TxtLibel), Trim(Me.txtLibel2)

   End If


    ' commit de la transaction en cours
    .Tere2Connection.CommitTrans

    ' ouverture nouvelle transaction
    .Tere2Connection.BeginTrans
   If FlagCand = True Then
      MAJ_TableauResultat
      End If
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
