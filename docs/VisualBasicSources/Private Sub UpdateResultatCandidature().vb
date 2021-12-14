Private Sub UpdateResultatCandidature()
  On Error GoTo RESU_ERR
  Dim i As Integer
    Me.MousePointer = vbHourglass
    With Me.grdResult
      For i = 1 To .Rows - 1
        DataEnvironment1.cmdModResultatCandidature .TextMatrix(i, 11), .TextMatrix(i, 9), .TextMatrix(i, 8), .TextMatrix(i, 12), .TextMatrix(i, 10), .TextMatrix(i, 0), .TextMatrix(i, 3)
      Next i
    End With
RESU_EXIT:
    Me.MousePointer = vbDefault
    Exit Sub
RESU_ERR:
    GestionErreur
    Me.grdResult.SetFocus
    Me.grdResult.Col = 3
    Me.grdResult.Row = i
    Resume RESU_EXIT
    'Remarque : la mise a jour ne sera prise ne compte
    'que lorsque la transaction en cours aura été "commitée"

End Sub
